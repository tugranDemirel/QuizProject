<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;

class MainController extends Controller
{
    //
    public function dashboard()
    {
        $results =  auth()->user()->results;
        $quizzes = Quiz::where('status', 'publish')->where(function ($query){
            $query->whereNull('finished_at')->orWhere('finished_at', '>', now());
        })->withCount('questions')->paginate(10);
        return view('dashboard', compact('quizzes', 'results'));
    }
    //
    public function quiz_detail($slug)
    {
        $quiz = Quiz::where('slug', $slug)->with('my_result', 'topTen.user')->withCount('questions')->first() ?? abort(404, 'QUİZ BULUNAMADI');

        return view('quiz_detail', compact('quiz'));
    }

    public function quiz($slug)
    {

        $quiz = Quiz::where('slug', $slug)->with('questions.my_answer', 'my_result')->first() ?? abort(404, 'QUİZ BULUNAMADI');
        if ($quiz->my_result)
        {
            return view('quiz_result', compact('quiz'));
        }
        return view('quiz', compact('quiz'));
    }

    public function result(Request $request, $slug)
    {
        $quiz = Quiz::with('questions')->where('slug', $slug)->first() ?? abort(404, 'QUİZ BULUNAMADI');
        $correct = 0;
        if($quiz->my_result)
        {
            abort(404, "BU QUİZ'E DAHA ÖNCE KATILDINIZ");
        }
        foreach ($quiz->questions as $question)
        {
                Answer::create([
                    'user_id'=>auth()->user()->id,
                    'question_id'=>$question->id,
                    'answer'=>$request->post($question->id)
                ]);


                if($question->correct_answer === $request->post($question->id))
                {
                    $correct +=1;
                }
        }
        $count = count($quiz->questions);
        $point = round((100/ $count) * $correct);
        $wrong = $count-$correct;
        Result::create([
            'user_id'=>auth()->user()->id,
            'quiz_id'=>$quiz->id,
            'point'=>$point,
            'correct'=>$correct,
            'wrong'=>$wrong
        ]);

        return redirect()->route('quiz.detail', $quiz->slug)->withSuccess("Başarıyla Quiz'i bitirdin. Puanın: ".$point." ");
    }

}
