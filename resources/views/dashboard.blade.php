<x-app-layout>
    <x-slot name="header">
       Anasayfa
    </x-slot>

    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach($quizzes as $quiz)
                <a href="{{route('quiz.detail', $quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$quiz->title}}</h5>
                        @if($quiz->finished_at)
                            <span class="badge badge-info" ><small>Bitiş Tarihi:</small> <br> {{$quiz->finished_at->diffForHumans()}}</span>
                        @endif
                    </div>
                    <p class="mb-1">{{Str::limit($quiz->description, 80)}}</p>
                    <small>Soru Sayısı: {{$quiz->questions_count}}</small>
                </a>
                @endforeach
                <div class="mt-2">{{$quizzes->links()}}</div>
            </div>
        </div>
        <div class="col-md-4">
            Girmiş Olduğum sınav verisi
        </div>
    </div>
</x-app-layout>
