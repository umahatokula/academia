<?php // Code within app\Helpers\Helper.php

	namespace App\Helpers;

	use \App\Role;
	use \App\Student;
	use \App\FeeSchedule;
	use \App\DiscountPolicy;
	use DB;

	use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
	// use App\InlineEmail;

	class Helper
	{
		//Make a slug out of a string
		public static function makeSlug($string)
		{
			return (strtolower(str_replace(' ', '_', $string)));
		}

		//Get permissions assigned to a role
		public static function getRolePermissions($role_id)
		{
			return array_keys(\Sentinel::findRoleById($role_id)->permissions);
		}

		//dot words in preparation to store as permssions
		public static function makePermissionsCRUD($string){
			$string = strtolower(str_replace(' ', '.', $string));
			$array = [];
			array_push($array, $string.'.create', $string.'.view', $string.'.update', $string.'.delete');

			return $array;
		}


		//Set all the permissions in the array to the truth value and return an array
		public static function prepPermissions($array, $truth_value){
			//array to hold final permission values
			$array_of_permissions = [];

			if(is_null($array)){
				return 	$array_of_permissions;
			}

			foreach ($array as $value) {
				$array_of_permissions[$value] = $truth_value;
			}

			return $array_of_permissions;
		}

		//get the name of the church for this pastor
		public static function getUsersChurch(){
			return \App\Person::find(\Session::get('user')->person_id)->church;
		}


		//et user's church by calling ${user}->church
	    public static function getSubjectTeacher($class_id, $subject_id) {
	        $teacher = \DB::table('class_subject')
	        ->join('staff', 'staff.id', '=', 'class_subject.staff_id')
	        ->where(['class_id' => $class_id, 'subject_id' => $subject_id ])->first();
	        // dd($teacher);
	        return $teacher;
	    }

	    public static function getFeeScheduleTotal($fee_schedule_code){
	    	return FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->sum('amount');
	    }


	    public static function getStudentCurrentBalance($student_id){
	    	return DB::table('student_ledgers')->where('student_id', $student_id)->sum('amount');
	    }

	    public static function sendStudentInvoice($emailcontent, $student_id){
	    	// dd($emailcontent);
	    	$inliner = new InlineEmail('emails.student_invoice', $emailcontent);
        	$content = $inliner->convert();
        	// dd($emailcontent);
        	

			\Mail::send  (
								'emails.raw', 
								['emailcontent' => $content],
								function($message) use($emailcontent){
										$message->to($emailcontent['parent_email'], 'Invoice')->subject('Testing Invoice');
								}
						);

	    	return true;

	    }

	    public static function discountEngine(){

	    	$parent_discount = self::getParentDiscount();

	    	return $discount;
	    }


	    public static function getParentDiscountEligibles () {
	    	$discount_policy = DiscountPolicy::where('discount_name', 'Parent')->first();

	    	$students = DB::select("SELECT students.id FROM students
                                INNER JOIN (
                                            SELECT students.parent_id
                                            FROM students
                                            GROUP BY students.parent_id
                                            HAVING count(parent_id) > $discount_policy->children_number
                                            )
                                dup ON students.parent_id = dup.parent_id
                                ORDER BY students.parent_id");
	    	$students = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($students)), FALSE);

	    	return $students;
	    }


	    /**
	     * @param  string
	     * @return double
	     */
	    public static function getParentDiscountAmount($fee_schedule_code){

	    	$discount_amount = 0;

	    	$discount_policy = DiscountPolicy::where('discount_name', 'Parent')->first();

	    	if($discount_policy->type == 'sum'){
	    		$discount_amount += $discount_policy->sum_value;
	    	}

	    	if($discount_policy->type == 'percentage'){

	    		$amount = 0;

	    		foreach(json_decode($discount_policy->affected_elements) as $fee_element_id){
	    			$amount += FeeSchedule::where(['fee_schedule_code' => $fee_schedule_code, 'fee_element_id' => $fee_element_id])->first()->amount;
	    		}

	    		$discount_amount += ($discount_policy->percentage_value/100) * $amount;
	    	}

	    	return $discount_amount;
	    }

	    /**
	     * @param  int
	     * @param  string
	     * @return double
	     */
	    public static function calculateParentDiscount ($student_id, $fee_schedule_code) {

        		//initialise discount to zero
        		$discount = 0;

	    		//get stuednt info
	    		$student = Student::find($student_id);

		        //get the parent discount value for this fee schedule
		        $parent_discount = self::getParentDiscountAmount($fee_schedule_code);

        		//get details of parent discount policy
        		$discount_policy = DiscountPolicy::where('discount_name', 'Parent')->first();

        		//get all wards with same parent
        		$same_parent = Student::select('id')->where('parent_id', $student->parent_id)->get()->toArray();

        		//divide parent discount accross all wards that have thesame parent
        		if($discount_policy->all_wards == 1){

        			$discount += $parent_discount/count($same_parent);
        			// dd($discount);

        			return $discount;

        		}

        		//dont divide parent discount accross all wards that have thesame parent
        		if($discount_policy->dont_divide == 1){

        			$discount += $parent_discount;

        			return $discount;
        			dd($discount);

        		}

        		if($discount_policy->all_wards == 0){

        			$student_ids = [];

        			foreach($same_parent as $stud){
        				$student_ids[] = $stud->id;
        			}

        			sort($student_ids);

        			foreach ($student_ids as $key => $student_id) {
        				if($key == ($discount_policy->ward_to_deduct- 1)){
        					$ward_to_deduct = $student_id;
        				}
        			}

        			if($ward_to_deduct == $student->id){
        				$discount += $parent_discount;

        				return $discount;
        			}else{
        				return $discount;
        			}

        		}

	    }


	    //=====================STAFF DISCOUNT======================

	    public static function getStaffDiscountEligibles () {
	    	$discount_policy = DiscountPolicy::where('discount_name', 'Staff')->first();

	    	$students = DB::select("SELECT students.id FROM students
                                INNER JOIN (
                                            SELECT students.staff_id
                                            FROM students
                                            GROUP BY students.staff_id
                                            HAVING count(staff_id) > $discount_policy->children_number
                                            )
                                dup ON students.staff_id = dup.staff_id
                                ORDER BY students.staff_id");
	    	$students = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($students)), FALSE);

	    	return $students;
	    }


	    /**
	     * @param  string
	     * @return double
	     */
	    public static function getStaffDiscountAmount($fee_schedule_code){

	    	$discount_amount = 0;

	    	$discount_policy = DiscountPolicy::where('discount_name', 'Staff')->first();

	    	if($discount_policy->type == 'sum'){
	    		$discount_amount += $discount_policy->sum_value;
	    	}

	    	if($discount_policy->type == 'percentage'){

	    		$amount = 0;

	    		foreach(json_decode($discount_policy->affected_elements) as $fee_element_id){
	    			$amount += FeeSchedule::where(['fee_schedule_code' => $fee_schedule_code, 'fee_element_id' => $fee_element_id])->first()->amount;
	    		}

	    		$discount_amount += ($discount_policy->percentage_value/100) * $amount;
	    	}

	    	return $discount_amount;
	    }

	    /**
	     * @param  int
	     * @param  string
	     * @return double
	     */
	    public static function calculateStaffDiscount ($student_id, $fee_schedule_code) {

        		//initialise discount to zero
        		$discount = 0;

	    		//get stuednt info
	    		$student = Student::find($student_id);

		        //get the staff discount value for this fee schedule
		        $staff_discount = self::getStaffDiscountAmount($fee_schedule_code);

        		//get details of staff discount policy
        		$discount_policy = DiscountPolicy::where('discount_name', 'Parent')->first();

        		//get all wards with same staff
        		$same_staff = Student::select('id')->where('staff_id', $student->staff_id)->get();

        		//divide staff discount accross all wards that have thesame staff
        		if($discount_policy->all_wards == 1){

        			$discount += $staff_discount/count($same_staff);

        			return $discount;

        		}

        		//dont divide staff discount accross all wards that have thesame staff
        		if($discount_policy->dont_divide == 1){

        			$discount += $staff_discount;

        			return $discount;

        		}

        		if($discount_policy->all_wards == 0){

        			$student_ids = [];

        			foreach($same_staff as $stud){
        				$student_ids[] = $stud->id;
        			}

        			sort($student_ids);

        			foreach ($student_ids as $key => $student_id) {
        				if($key == ($discount_policy->ward_to_deduct- 1)){
        					$ward_to_deduct = $student_id;
        				}
        			}

        			if($ward_to_deduct == $student->id){
        				$discount += $staff_discount;
        			}

        			return $discount;
        		}

	    }



	    /**
	     * get scores for a student for a subject in  a class
	     * @param  [int] $class_id   [description]
	     * @param  [int] $student_id [description]
	     * @param  [int] $subject_id [description]
	     * @return [object]
	     */
	    public static function get_subject_scores($class_id, $student_id, $subject_id){
	    	$table = 'class_results_'.\Session::get('current_session').'_'.\Session::get('current_term');
	    	$subject_scores = \DB::table($table)
	    	->where([	
	    				'class_id' => $class_id,
	    				'student_id' => $student_id,
	    				'subject_id' => $subject_id])
	    	->first();

	    	return $subject_scores;
	    }



	     /**
	     * get a students psoition in class.
	     * @param  [int] $class_id   [description]
	     * @param  [int] $student_id [description]
	     * @param  [int] $subject_id [description]
	     * @return [object]
	     */
	    public static function get_student_position($class_id, $student_id, $subject_id){
	    	$table = 'class_positions_'.\Session::get('current_session').'_'.\Session::get('current_term');
	    	$student_position = \DB::table($table)
	    	->where([	
	    				'class_id' => $class_id,
	    				'student_id' => $student_id
	    				])
	    	->first();

	    	return $student_position;
	    }


	    /**
	     * calculates students' position in a class. Can also be used for student's position in a subject
	     * @param  array $results student_id and score pair
	     * @return array          an array where key is student_id and value is position
	     */
	    public static function calculate_position($results) {

	    	//sort result array in descending order (ie highest to lowest)
	    	arsort($results);
	    	// dd($results);

	    	//array to hold positions of all students
	    	$positions = [];

	    	//initialize position to 0
	    	$position = 1;

	    	//temp variable for last score used to compare with present score in the foreach loop
	    	$temp_score = 0;

	    	//increments any time there is a tie in score and deducted from position
	    	$counter = 1;

	    	foreach ($results as $student_id => $score) {

	    		//ensure that there is at least a student with a total score above zero
	    		if(array_sum($results) == 0){
	    			return $results;
	    		}

	    		if($score === $temp_score) {

	    			$positions[$student_id] = $position - $counter;

	    			$counter++;

	    		} else {

	    			$positions[$student_id] = $position;

	    			$counter = 1;

	    		}

	    		$temp_score = $score;

	    		$position++;

	    	}

	    	return $positions;
	    }


	    /**
	     * get a students psoition suffix
	     * @param  int $int position
	     * @return string      the suffix eg st, nd, rd, th
	     */
	    public static function get_suffix($position) {

	    	$position = substr($position, -1, 1);
	    	$suffix = '';

		    switch ($position) {
			    case 1:
			        $suffix = 'st';
			        break;
			    case 2:
			        $suffix = 'nd';
			        break;
			    case 3:
			        $suffix = 'rd';
			        break;
			    default:
       				$suffix = 'th';
			}

			return $suffix;
	    }


		/**
		 * get grade based on subject total
		 * @param  int $subject_total total scores by a student in a subject
		 * @return string                grade obtained in a subject
		 */
	    public static function get_grade($subject_total) {

	    	if ($subject_total <= 39) {
	    		return "F";
	    	} elseif ($subject_total >= 39 && $subject_total <= 50 ) {
	    		return "D";
	    	} elseif ($subject_total >= 51 && $subject_total <= 60 ) {
	    		return "C";
	    	} elseif ($subject_total >= 61 && $subject_total <= 75 ) {
	    		return "B";
	    	} else {
	    		return "A";
	    	}

	    }


	    /**
	     * get subjects that a student is exempted from
	     * @param  int $class_id   student's class id
	     * @param  int $student_id student's id
	     * @return array 			array of exempted subjects
	     */
	    public static function get_exempted_subjects($class_id, $student_id) {
	    	$subject_exemption_table = 'subject_exemption_'.\Session::get('current_session').'_'.\Session::get('current_term');

	    	$exempted_subjects = \DB::table($subject_exemption_table)
	    							->where([
	    										'class_id' 		=> $class_id,
	    										'student_id' 	=> $student_id,
	    										'state'			=> 0
	    									])
	    							->lists('subject_id');

	    	// dd($exempted_subjects);
	    	return $exempted_subjects;
	    }

	    /**
	     * get subjects that a student is offering
	     * @param  int $class_id   student's class id
	     * @param  int $student_id student's id
	     * @return array 			array of exempted subjects
	     */
	    public static function get_offered_subjects($class_id, $student_id) {
	    	//get table name based on current session and term
	    	$subject_exemption_table = 'subject_exemption_'.\Session::get('current_session').'_'.\Session::get('current_term');

	    	$offered_subjects = \DB::table($subject_exemption_table)
	    	->join('subjects', 'subjects.id', '=', $subject_exemption_table.'.subject_id')
	    	->where([
	    		'class_id' 		=> $class_id,
	    		'student_id' 	=> $student_id,
	    		'state'			=> 1
	    		])
	    	->lists('subject_id', 'subject');

	    	return $offered_subjects;
	    }


	    /**
	     * get the number of students offering a subject
	     * @param  int $class_id   id of class in question
	     * @param  int $subject_id id of subject in question
	     * @return int             number of students offering a subject
	     */
	    public static function get_number_offering_subject($class_id, $subject_id) {
	    	$subject_exemption_table = 'subject_exemption_'.\Session::get('current_session').'_'.\Session::get('current_term');
	    	$subjects = \DB::table($subject_exemption_table)
	    							->where([
	    										'class_id' 		=> $class_id,
	    										'subject_id' 	=> $subject_id,
	    										'state'			=> 1
	    									])
	    							->get();
	    	return count($subjects);
	    }


	    /**
	     * get maximum scored in a subject in a class
	     * @param  int $class_id   id of class in question
	     * @param  int $subject_id id of subject in question
	     * @return int             maximum scored
	     */
	    public static function max_subject_score($class_id, $subject_id) {

	    	$table = 'class_results_'.\Session::get('current_session').'_'.\Session::get('current_term');	    	

	    	$max_subject_total = DB::table($table)
	    							->where([
	    										'class_id' 		=> $class_id,
	    										'subject_id' 	=> $subject_id
	    									])
	    							->max('subject_total');

	    	return $max_subject_total;

	    }


	    /**
	     * get class average in a subject
	     * @param  int $class_id   id of class in question
	     * @param  int $subject_id id of subject in question
	     * @return int            average of the class in the subject
	     */
	    public static function subject_class_average($class_id, $subject_id) {

	    	$table = 'class_results_'.\Session::get('current_session').'_'.\Session::get('current_term');	    	

	    	$subject_total = DB::table($table)
	    							->where([
	    										'class_id' 		=> $class_id,
	    										'subject_id' 	=> $subject_id
	    									])
	    							->sum('subject_total');
	    	$number_offering_subject = self::get_number_offering_subject($class_id, $subject_id);

	    	$class_average = $subject_total/$number_offering_subject;

	    	return $class_average;

	    }


	    /**
	     * get remark based in grade
	     * @param  string $grade   graded student scored
	     * @return string            remark
	     */
	    public static function get_remark($grade) {

	    	$remark = '';

		    switch ($grade) {
			    case 'A':
			        $remark = 'Excellent';
			        break;
			    case 'B':
			        $remark = 'Very Good';
			        break;
			    case 'C':
			        $remark = 'Good';
			        break;
			    case 'D':
			        $remark = 'Fair';
			        break;
			    case 'F':
			        $remark = 'Fail';
			        break;
			}

			return $remark;

	    }

	}