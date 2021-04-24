<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} için yeni soru oluştur
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('questions.store', $quiz->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Soru</label>
                    <textarea  class="form-control" name="question" cols="30" rows="4">{{ old('question') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Fotoğraf</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 1</label>
                            <textarea  class="form-control" name="answer1" cols="30" rows="2">{{ old('answer1') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 2</label>
                            <textarea  class="form-control" name="answer2" cols="30" rows="2">{{ old('answer2') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 3</label>
                            <textarea  class="form-control" name="answer3" cols="30" rows="2">{{ old('answer3') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cevap 4</label>
                            <textarea  class="form-control" name="answer4" cols="30" rows="2">{{ old('answer4') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Doğru Cevap</label>
                    <select class="form-control" name="correct_answer" id="">
                        <option @if(old('correct_answer')==='answer1') selected @endif value="answer1">1. Cevap</option>
                        <option @if(old('correct_answer')==='answer2') selected @endif value="answer2">2. Cevap</option>
                        <option @if(old('correct_answer')==='answer3') selected @endif value="answer3">3. Cevap</option>
                        <option @if(old('correct_answer')==='answer4') selected @endif value="answer4">4. Cevap</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block" type="submit" name="">{{$quiz->title}}'a Ait Soru Oluştur</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
