<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} Sonucu
    </x-slot>

    <div class="card" >
        <div class="d-flex alert alert-link">
            <div class="">

                <label class="form-check-label text-info  h3" >Puanınız: {{$quiz->my_result->point}} </label>
            </div>
            <div class="ml-auto ">
                <label class="form-check-label text-success " >Doğru Cevap Sayınız: {{$quiz->my_result->correct}} </label><br>
                <label class="form-check-label text-danger " >Yanlış Cevap Sayınız: {{$quiz->my_result->wrong}}</label>
            </div>
        </div>
        <div class="card-body">

            <form >
                @foreach($quiz->questions as $question)
                <div class="row">
                    <div class="">

                        <strong>{{$loop->iteration}} -
                            @if($question->correct_answer == $question->my_answer->answer)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </strong>{{$question->question}}
                        @if($question->image)
                            <img width="50%" src="{{asset($question->image)}}" alt="$question->title">
                        @endif
                        <div class="form-check mt-3" >
                            @if('answer1' == $question->correct_answer)
                                <label class="form-check-label text-success" for="quiz{{$question->id}}1">
                                    {{$question->answer1}}
                                </label>
                            @elseif($question->my_answer->answer == 'answer1')
                                <label class="form-check-label text-danger" for="quiz{{$question->id}}1">
                                    {{$question->answer1}}
                                </label>
                            @else
                                <label class="form-check-label" for="quiz{{$question->id}}1">
                                    {{$question->answer1}}
                                </label>
                            @endif
                        </div>
                        <div class="form-check">
                            @if('answer2' == $question->correct_answer)
                                <label class="form-check-label text-success" for="quiz{{$question->id}}2">
                                    {{$question->answer2}}
                                </label>
                            @elseif($question->my_answer->answer == 'answer2')
                                <label class="form-check-label text-danger" for="quiz{{$question->id}}2">
                                    {{$question->answer2}}
                                </label>
                            @else
                                <label class="form-check-label " for="quiz{{$question->id}}2">
                                    {{$question->answer2}}
                                </label>
                            @endif

                        </div>
                        <div class="form-check">
                            @if('answer3' == $question->correct_answer)

                                <label class="form-check-label text-success" for="quiz{{$question->id}}3">
                                    {{$question->answer3}}
                                </label>
                            @elseif($question->my_answer->answer == 'answer3')
                                <label class="form-check-label text-danger" for="quiz{{$question->id}}3">
                                    {{$question->answer3}}
                                </label>
                            @else

                                <label class="form-check-label" for="quiz{{$question->id}}3">
                                    {{$question->answer3}}
                                </label>
                            @endif
                        </div>
                        <div class="form-check">
                            @if('answer4' == $question->correct_answer)
                                <label class="form-check-label text-success" for="quiz{{$question->id}}4">
                                    {{$question->answer4}}
                                </label>
                            @elseif($question->my_answer->answer == 'answer4')
                                <label class="form-check-label text-danger" for="quiz{{$question->id}}4">
                                    {{$question->answer4}}
                                </label>
                            @else
                                <label class="form-check-label" for="quiz{{$question->id}}4">
                                    {{$question->answer4}}
                                </label>
                            @endif

                        </div>
                    </div>
                    <div class=" ml-auto p-2">
                        <small>Bu soruya <strong class="text-info">%{{$question->true_percent}}</strong> oranında doğru cevap verilmiştir.</small>
                    </div>
                </div>
                    <hr>
                @endforeach
                <a href="{{route('quiz.detail', $quiz->slug)}}" class="btn btn-info btn-sm btn-block ">Geri Dön</a>
            </form>
        </div>
    </div>
</x-app-layout>



