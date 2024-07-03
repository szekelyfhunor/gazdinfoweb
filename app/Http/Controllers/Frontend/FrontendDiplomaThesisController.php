<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Classes;
use App\Models\DiplomaThesis;
use App\Models\Topic;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class FrontendDiplomaThesisController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $possibleClasses = Classes::where('is_finished','=','1')->orderBy('year', 'DESC')->get();
        $classes = $possibleClasses->reject(function ($possibleCLass, $key) {
            foreach($possibleCLass->students as $student){
                if($student->diplomathese){
                    return false;
                }
            }
            return true;
        });
        $allTopics = Topic::all();
        $topics = $allTopics->filter(function ($topic) {
            foreach ($topic->diplomatheses as $diplomathesis) {
                if ($diplomathesis->status === 'accepted') {
                    foreach ($diplomathesis->topics as $dtTopic) {
                        if ($dtTopic->id === $topic->id) {
                            return true; // Include the topic if it is associated with any diploma thesis with 'accepted' status
                        }
                    }
                }
            }
            return false; // Exclude the topic if it is not associated with any diploma thesis with 'accepted' status
        });


        //dd($topics);

        $diplomatheses = DiplomaThesis::whereNotNull('student_id')->get();

        return view('frontend.diplomatheses.index', compact('classes','diplomatheses', 'topics'));
    }
}


