<?php // Code within app\Helpers\NewTerm.php

	namespace App\Helpers;

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;

	use \App\Role;
	use \App\Student;
	use \App\FeeSchedule;
	use \App\DiscountPolicy;
	use DB;

	class NewTerm
	{
		public static function createClassResult($session, $term_id) {
			try{
				\Schema::create('class_results_'.$session.'_'.$term_id, function (Blueprint $table) {
		            $table->integer('class_id');
		            $table->integer('student_id');
		            $table->integer('subject_id');
		            $table->double('ca1', 11, 2)->default(0);
		            $table->double('ca2', 11, 2)->default(0);
		            $table->double('ca3', 11, 2)->default(0);
		            $table->double('exam', 11, 2)->default(0);
		            $table->double('subject_total', 11, 2)->default(0);
		            $table->integer('subject_position')->default(0);
		            $table->string('grade')->nullable();
		            $table->integer('status_id')->default(1);
		            $table->primary(array('class_id', 'student_id', 'subject_id'));
		            $table->softDeletes();
		            $table->timestamps();
			        });
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1050){
                        session()->flash('flash_message', 'Result table for chosen session and term already exists.');
                        return \Redirect::back()->withInput();
                    }
                }
		}


		public static function createClassPosition($session, $term_id) {
			try{
				\Schema::create('class_positions_'.$session.'_'.$term_id, function (Blueprint $table) {
		            $table->integer('class_id');
		            $table->integer('student_id');
		            $table->double('total', 11, 2)->default(0);
		            $table->double('average', 11, 2)->default(0);
		            $table->integer('position')->default(0);
		            $table->integer('status_id')->default(1);
		            $table->primary(array('class_id', 'student_id'));
		            $table->softDeletes();
		            $table->timestamps();
			        });
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1050){
                        session()->flash('flash_message', 'Position table for chosen session and term already exists.');
                        return \Redirect::back()->withInput();
                    }
                }
		}


		public static function createSubjectExemption($session, $term_id) {
			try{
				\Schema::create('subject_exemption_'.$session.'_'.$term_id, function (Blueprint $table) {

					$table->integer('class_id');
		            $table->integer('student_id');
		            $table->integer('subject_id');
		            $table->integer('state')->default(1);
		            $table->primary(array('class_id', 'student_id', 'subject_id'));
		            $table->softDeletes();
		            $table->timestamps();
				});
			}catch (\Illuminate\Database\QueryException $e){
				$errorCode = $e->errorInfo[1];
				if($errorCode == 1050){
					session()->flash('flash_message', 'Subject Exemption table for chosen session and term already exists.');
					return \Redirect::back()->withInput();
				}
			}
		}
	}