<?php

namespace App\Http\Controllers;

use App\Question;
use App\Http\Requests\AskQuestionRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // \DB::enableQueryLog();
        $questions = Question::with('user')->latest()->paginate(5);

        // $questions = Question::latest()->paginate(5);

        return view('questions.index', compact('questions'));

        // view('questions.index', compact('questions'))->render();
        // dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));

        return redirect()->route('questions.index')->with('success', 'Your questions has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if (Gate::allows('update-question', $question)) {
            return view('questions.edit', compact('question'));
        }

        abort(403, 'Access denied');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, 'Access denied');
        }

        $question->update($request->only('title', 'body'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Question has been updated',
                'body_html' => $question->body_html
            ]);
        }

        return redirect('/questions')->with('success', 'Question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question) // $id
    {
        // if(Gate::denies('delete-question', $question))
        // {
        //     abort(403, 'Access denied');
        // }

        $this->authorize('delete', $question);

        $question->delete();

        if (\request()->expectsJson()) {
            return response()->json([
                'message' =>  'Questions has been deleted!',
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Questions has been deleted!');
    }
}
