<?php // Code within app\Helpers\Helper.php

	namespace App\Helpers;

	use \App\Role;

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

	}