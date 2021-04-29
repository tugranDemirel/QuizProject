<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
// validate ayarlarini yaoptigim sayfasi import ettim
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.create', compact('quiz'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $quiz_id)
    {
        //
        if ($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;

            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image'=>$fileNameWithUpload
            ]);
        }
        Quiz::find($quiz_id)->questions()->create($request->post());
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Oluşturuldu');
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
    public function edit($quiz_id, $question_id)
    {
        //
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404,'Böyle Bir Quiz veya Soru Bulunamadı');
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id, $question_id)
    {
        if ($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;

            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image'=>$fileNameWithUpload
            ]);
        }

        Quiz::find($quiz_id)->questions()->where('id', $question_id)->first()->update($request->post());
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $question_id)
    {
        //
        Quiz::find($quiz_id)->questions()->where('id', $question_id)->delete() ?? abort(404, 'QUİZ BULUNAMADI');
        return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru Başarıyla Silindi');
    }
}
