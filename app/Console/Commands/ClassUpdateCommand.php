<?php

namespace App\Console\Commands;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClassUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'classes:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will update the classes table!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $classes = Classes::all();
            foreach ($classes as $class) {
                if ($class->is_finished == 0 && $class->current_grade < 3) {
                    Classes::where('id', $class->id)->update(['current_grade' => $class->current_grade + 1]);
                } else if ($class->is_finished == 0 && $class->current_grade == 3) {
                    Classes::where('id', $class->id)->update(['is_finished' => 1]);
                    foreach ($class->students as $student) {
                        Student::where('id', $student->id)->update(['status' => 0, 'year_of_finish' => date('Y')]);
                    }
                }
            }
            echo "Classes updated successfully!";
        } catch (\Exception $e) {
            echo "Classes update failed!";
        }
    }
}
