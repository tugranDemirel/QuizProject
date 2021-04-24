<x-app-layout>
    <x-slot name="header">
        {{$question->title}} sorusunu düzenle
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('questions.update',[$question->quiz_id, $question->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Soru</label>
                    <textarea  class="form-control" name="question" cols="30" rows="4">{{ $question->question }}</textarea>
                </div>
                <div class="form-group">
                    <a href="{{asset($question->image)}}" target="_blank">
                        @if($question->image)
                            <img style="width: 150px!important;" src="{{asset($question->image)}}" alt="{{$question->question}}">
                        @else
                            <img style="width: 150px!important;" src="{{asset('uploads/resim-yok.jpg')}}" alt="{{$question->question}}">
                        @endif
                    </a>
                    <label for="">Fotoğraf</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 1</label>
                            <textarea  class="form-control" name="answer1" cols="30" rows="2">{{ $question->answer1 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 2</label>
                            <textarea  class="form-control" name="answer2" cols="30" rows="2">{{ $question->answer2 }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 3</label>
                            <textarea  class="form-control" name="answer3" cols="30" rows="2">{{ $question->answer3 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 4</label>
                            <textarea  class="form-control" name="answer4" cols="30" rows="2">{{ $question->answer4 }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Doğru Cevap</label>
                    <select class="form-control" name="correct_answer" id="">
                        <option @if($question->correct_answer==='answer1') selected @endif value="answer1">1. Cevap</option>
                        <option @if($question->correct_answer==='answer2') selected @endif value="answer2">2. Cevap</option>
                        <option @if($question->correct_answer==='answer3') selected @endif value="answer3">3. Cevap</option>
                        <option @if($question->correct_answer==='answer4') selected @endif value="answer4">4. Cevap</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block" type="submit" name="">{{$question->title}}'a Ait Soruyu Düzenle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
