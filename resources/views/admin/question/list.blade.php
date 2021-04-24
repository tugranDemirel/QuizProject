<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}'e Ait Sorular
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title float-left">
                <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-alt-circle-left mr-1"></i>Quizlere Dön</a>
            </h5>
            <h5 class="card-title float-right">
                <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-plus mr-1"></i>Soru Oluştur</a>
            </h5>
            <table class="table table-bordered table-sm
">
                <thead>
                <tr>
                    <th scope="col">Soru</th>
                    <th scope="col" >Fotoğraf</th>
                    <th scope="col">1. Cevap</th>
                    <th scope="col">2. Cevap</th>
                    <th scope="col">3. Cevap</th>
                    <th scope="col">4. Cevap</th>
                    <th scope="col">Doğru Cevap</th>
                    <th scope="col" width="100">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quiz->questions as $question)
                <tr>
                    <td>{{$question->question}}</td>
                    <td>
                        @if($question->image)
                            <img style="width: 150px!important;" src="{{asset($question->image)}}" alt="{{$question->question}}" class="img-thumbnail">
                        @else
                            <img style="width: 150px!important;" src="{{asset('uploads/resim-yok.jpg')}}" alt="{{$question->question}}" class="img-thumbnail">
                        @endif
                    </td>
                    <td>{{$question->answer1}}</td>
                    <td>{{$question->answer2}}</td>
                    <td>{{$question->answer3}}</td>
                    <td>{{$question->answer4}}</td>
                    <td class="text-success">
                        @php
                            $ca = $question->correct_answer;
                            echo $question->$ca;
                        @endphp
                    </td>
                    <td>
                        <a title="Düzenle" href="{{route('questions.edit',[$quiz->id, $question->id] )}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a title="Sil" href="{{route('questions.destroy',[$quiz->id, $question->id])}}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
