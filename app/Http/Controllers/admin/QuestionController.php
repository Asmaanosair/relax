<?php

namespace App\Http\Controllers\admin;

use App\Clinic;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $question = Question::paginate(20);

        return view('admin.question.index', ['question' => $question]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinics = Clinic::all();
        return view('admin.question.create', ['clinics' => $clinics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $data = $request->all();
        Question::create($data);
        return redirect(route('admin.question.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $clinics = Clinic::all();
        return view('admin.question.edit', ['clinics' => $clinics, 'question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $data = $request->all();
        $question->update($data);
        return redirect(route('admin.question.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return back();
    }
}
