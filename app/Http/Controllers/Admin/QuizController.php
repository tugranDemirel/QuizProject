<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $quizzes = Quiz::withCount('questions');

        // get ile parametre yakalama islemi
        if (request()->get('title'))
        {
            $quizzes = $quizzes->where('title', 'LIKE' ,"% ".request()->get('title')." %");
        }
        if (request()->get('status'))
        {
            $quizzes = $quizzes->where('status', request()->get('status'));
        }
        $quizzes = $quizzes->paginate(5);
        return view('admin.quiz.list', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.quiz.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
        QuizCreateRequest requestini kullanarak formlardaki ilgili kontrolleri gerceklestirdik
     */
    public function store(QuizCreateRequest $request)
    {
        // db ye verileri kayit etme fonksiyonu
        Quiz::create($request->post());

        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404, 'QUİZ BULUNAMADI');
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
        QuizUpdateRequest requestini kullanarak formlardaki ilgili kontrolleri gerceklestirdik
     */

    public function update(QuizUpdateRequest $request, $id)
    {
        //
        $quiz = Quiz::find($id) ?? abort(404, 'QUİZ BULUNAMADI');

        Quiz::find($id)->update($request->except(['_method', '_token']));
        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $quiz = Quiz::find($id) ?? abort(404, 'QUİZ BULUNAMADI');
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Silindi');
    }
}
