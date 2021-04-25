<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="card" >
        <div class="card-body">
            <p class="card-text">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group mb-4">

                            @if($quiz->my_result)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Puan
                                    <span class="badge badge-success badge-pill">{{ $quiz->my_result->point }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Doğru / Yanlış Sayısı
                                    <span class="badge badge-warning badge-pill">{{$quiz->my_result->correct . " / ".$quiz->my_result->wrong}}</span>
                                </li>
                            @endif
                           @if($quiz->finished_at)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Son Katılım Tarihi
                                    <span title="{{$quiz->finished_at}}" class="badge badge-info badge-pill">{{$quiz->finished_at->diffForHumans()}}</span>
                                </li>
                           @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge badge-light badge-pill">{{$quiz->questions_count}}</span>
                            </li>
                            @if($quiz->details)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Katılımcı Sayısı
                                    <span class="badge badge-light badge-pil l">{{$quiz->details['join_count']}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Ortalama Puan
                                    <span class="badge badge-light badge-pill">{{$quiz->details['average']}}</span>
                                </li>
                            @endif
                        </ul>
                        @if(count($quiz->topTen) > 0)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">İlk 10</h5>
                                    <ul class="list-gorup">
                                        @foreach($quiz->topTen as $result)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong class="">{{$loop->iteration}}.</strong> <img src="{{asset($result->user->profile_photo_url)}}" width="50px;" alt="{{$result->user->name}}">
                                                 {{$result->user->name}}<span class="badge badge-success badge-pill float-right">{{$result->point}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        {{$quiz->description}}<br> <br>
                        @if($quiz->my_result)
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-info btn-sm btn-block float-right">Quiz'i Görüntüle</a>
                        @else
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-primary btn-sm btn-block float-right">Quiz'e Katıl</a>
                        @endif
                    </div>
                </div>
            </p>
        </div>
    </div>
</x-app-layout>
