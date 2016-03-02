<?php // Code within app\Helpers\NewTerm.php

namespace App\Helpers;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use \App\Role;
use \App\Student;
use \App\FeeSchedule;
use \App\DiscountPolicy;
use \App\ClassResult;
use \App\ClassPosition;
use \App\SubjectExemption;
use \App\Invoice;
use \App\Position;
use \App\Promotion;
use DB;

class NewTerm
{
	public static function createClassResult($session, $term_id) {
		try{
				//create new record for this table in the termly records table
			$class_result = new ClassResult;
			$class_result->table_name = 'class_results_'.$session.'_'.$term_id;
			$class_result->session = $session;
			$class_result->term = $term_id;
			$class_result->save();


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
				$error_msg[] = 'Result table for chosen session and term already exists.';
                        // session()->flash('flash_message', 'Result table for chosen session and term already exists.');
				return \Redirect::back()->withInput();
			}
		}
	}


	public static function createClassPosition($session, $term_id) {
		try{
				//create new record for this table in the termly records table
			$class_position = new ClassPosition;
			$class_position->table_name = 'class_positions_'.$session.'_'.$term_id;
			$class_position->session = $session;
			$class_position->term = $term_id;
			$class_position->save();


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
				$error_msg[] = 'Position table for chosen session and term already exists.';
                        // session()->flash('flash_message', 'Position table for chosen session and term already exists.');
                        // return \Redirect::back()->withInput();
			}
		}
	}


	public static function createSubjectExemption($session, $term_id) {
		try{
			//we are using subject_ex_ here istead of subject_exemption_ cos primary keys are too long using the the latter thereby hrowing an error
			//create new record for this table in the termly records table
			$subject_exemption = new SubjectExemption;
			$subject_exemption->table_name = 'subject_ex_'.$session.'_'.$term_id;
			$subject_exemption->session = $session;
			$subject_exemption->term = $term_id;
			$subject_exemption->save();


			\Schema::create('subject_ex_'.$session.'_'.$term_id, function (Blueprint $table) {
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
				$error_msg[] = 'Position table for chosen session and term already exists.';
                        // session()->flash('flash_message', 'Position table for chosen session and term already exists.');
                        // return \Redirect::back()->withInput();
			}
		}
	}


	public static function createInvoices($session, $term_id) {
		try{
				//create new record for this table in the termly records table
			$invoice = new Invoice;
			$invoice->table_name = 'invoices_'.$session.'_'.$term_id;
			$invoice->session = $session;
			$invoice->term = $term_id;
			$invoice->save();


			\Schema::create('invoices_'.$session.'_'.$term_id, function (Blueprint $table) {
				$table->integer('student_id');
				$table->string('fee_schedule_code');
				$table->string('invoice_number');
				$table->double('amount', 15, 2);
				$table->double('discount', 15, 2);
				$table->double('balance', 15, 2);
				$table->double('total', 15, 2);
				$table->json('exempted_fee_elements')->nullable();
				$table->integer('status_id')->default(4);
				$table->primary(array('student_id', 'fee_schedule_code'));
				$table->softDeletes();
				$table->timestamps();
			});



		}catch (\Illuminate\Database\QueryException $e){
			$errorCode = $e->errorInfo[1];
			if($errorCode == 1050){
				$error_msg[] = 'Invoices table for chosen session and term already exists.';
					// session()->flash('flash_message', 'Invoices table for chosen session and term already exists.');
					// return \Redirect::back()->withInput();
			}
		}
	}


	public static function createPromotionTable($session, $term_id) {
		try{

				//create new record for this table in the termly records table
			$promotion = new Promotion;
			$promotion->table_name = 'promotions_'.$session.'_'.$term_id;
			$promotion->session = $session;
			$promotion->term = $term_id;
			$promotion->save();


			\Schema::create('promotions_'.$session.'_'.$term_id, function (Blueprint $table) {
				$table->increments('id');
				$table->integer('student_id');
				$table->integer('class_id');
				$table->integer('average_score');
				$table->softDeletes();
				$table->timestamps();
			});


		}catch (\Illuminate\Database\QueryException $e){
			$errorCode = $e->errorInfo[1];
			if($errorCode == 1050){
				$error_msg[] = 'Promotion table for chosen session and term already exists.';
					// session()->flash('flash_message', 'Invoices table for chosen session and term already exists.');
					// return \Redirect::back()->withInput();
			}
		}
	}


	public static function createFeeScheduleTable($session, $term_id) {
		try{
		//we are using fee_sch_ here istead of fee_schedules_ cos primary keys are too long using the the latter thereby hrowing an error
			// create new record for this table in the termly records table
			$fee_schedule = new FeeSchedule;
			$fee_schedule->table_name = 'fee_sch_'.$session.'_'.$term_id;
			$fee_schedule->session = $session;
			$fee_schedule->term = $term_id;
			$fee_schedule->save();


			\Schema::create('fee_sch_'.$session.'_'.$term_id, function (Blueprint $table) {
				$table->string('fee_schedule_code');
				$table->integer('fee_element_id');
				$table->double('amount', 15, 2)->default(0.00);
				$table->string('session');
				$table->integer('term_id');
				$table->integer('class_id');
				$table->integer('status_id')->default(1);
				$table->primary(array('fee_schedule_code', 'fee_element_id'));
				$table->softDeletes();
				$table->timestamps();
			});



		}catch (\Illuminate\Database\QueryException $e){
			$errorCode = $e->errorInfo[1];
			if($errorCode == 1050){
				$error_msg[] = 'Fee Schedule table for chosen session and term already exists.';
					// session()->flash('flash_message', 'Invoices table for chosen session and term already exists.');
					// return \Redirect::back()->withInput();
			}
		}
	}
}