<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTopicRequest;
use App\Http\Requests\EditTopicRequest;
use App\Models\Topic;
use App\Models\TypeOfParticipation;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $topics = Topic::all();
        return view('dashboard.topics.index', compact('topics'));
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Topic $topic){
        $topic->delete();
        return redirect()->route('dashboard.topics.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dashboard.topics.create');
    }

    /**
     * @param CreateTopicRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTopicRequest $request)
    {
        Topic::create($request->validated());
        return redirect()->route('dashboard.topics.index');
    }


    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Topic $topic)
    {
        return view('dashboard.topics.edit', compact('topic'));
    }

    /**
     * @param EditTopicRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditTopicRequest $request, Topic $topic)
    {
        $topic->update($request->validated());
        return redirect()->route('dashboard.topics.index');
    }
}
