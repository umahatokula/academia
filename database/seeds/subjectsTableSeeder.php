<?php

use Illuminate\Database\Seeder;

use \App\Subject;

class subjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('subjects')->truncate();

        Subject::create(['subject' => 'English', 'status_id' => 1]);

        Subject::create(['subject' => 'Mathematics', 'status_id' => 1]);

        Subject::create(['subject' => 'Physics', 'status_id' => 1]);

        Subject::create(['subject' => 'Biology', 'status_id' => 1]);

        Subject::create(['subject' => 'Chemistry', 'status_id' => 1]);

        Subject::create(['subject' => 'Introductory Technology', 'status_id' => 1]);

        Subject::create(['subject' => 'Agricultural Science', 'status_id' => 1]);

        Subject::create(['subject' => 'Geography', 'status_id' => 1]);

        Subject::create(['subject' => 'Fine Arts', 'status_id' => 1]);

        Subject::create(['subject' => 'French', 'status_id' => 1]);

        Subject::create(['subject' => 'Yoruba', 'status_id' => 1]);

        Subject::create(['subject' => 'Hausa', 'status_id' => 1]);

        Subject::create(['subject' => 'Igbo', 'status_id' => 1]);

        Subject::create(['subject' => 'Economics', 'status_id' => 1]);
    }
}
