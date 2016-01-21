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
	        return $teacher->fname.' '.$teacher->lname;
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
        		$same_parent = Student::select('id')->where('parent_id', $student->parent_id)->get();

        		//divide parent discount accross all wards that have thesame parent
        		if($discount_policy->all_wards == 1){

        			$discount += $parent_discount/count($same_parent);

        			return $discount;

        		}

        		//dont divide parent discount accross all wards that have thesame parent
        		if($discount_policy->dont_divide == 1){

        			$discount += $parent_discount;

        			return $discount;

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
        			}

        			return $discount;
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

	}