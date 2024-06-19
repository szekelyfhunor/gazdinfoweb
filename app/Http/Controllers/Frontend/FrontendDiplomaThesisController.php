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
        $allTopics = Topic::with('diplomatheses.topics')->get();
        $topics = $allTopics->filter(function ($topic) {
            foreach ($topic->diplomatheses as $diplomathesis) {
                foreach ($diplomathesis->topics as $dtTopic) {
                    if ($dtTopic->id === $topic->id) {
                        return false;
                    }
                }
            }
            return true;
        });

        $diplomatheses = DiplomaThesis::all();

        if (!isset($diplomatheses->topics)) {
            dd('Topics relationship is not set on diplomathesis:', $diplomatheses);
        }
        

        return view('frontend.diplomatheses.index', compact('classes','diplomatheses', 'topics'));
    }
}


