<?php // Code within app\Helpers\Helper.php

	namespace App\Helpers;

	use \App\Role;
	use \App\FeeSchedule;
	use DB;

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

	    public static function discountEngine($student_id){
	    	$discount = 0;
	    	return $discount;
	    }


	    public static function getStudentCurrentBalance($student_id){
	    	return DB::table('student_ledgers')->where('student_id', $student_id)->sum('amount');
	    }

	}