<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="card" >
        <div class="card-body">
            <p class="card-text">
                <a href="{{route('quizzes.index')}}" class="btn btn-info btn-sm float-right">Geri Dön</a>
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group mb-4">
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
                                            <strong class="">{{$loop->iteration}}.</strong>
                                            <img class="float-left" src="{{asset($result->user->profile_photo_url)}}" width="50px;" alt="{{$result->user->name}}">
                                            <span @if($result->user_id == auth()->user()->id) class="text-danger"@endif>{{$result->user->name}}</span>
                                            <span class="badge badge-success badge-pill float-right">{{$result->point}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    {{$quiz->description}}

                    <br> <br>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ad Soyad</th>
                            <th scope="col">Puan</th>
                            <th scope="col">Doğru</th>
                            <th scope="col">Yanlış</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->results as $result)
                            <tr>
                                <th scope="">{{$loop->iteration}}</th>
                                <td >{{$result->user->name}}</td>
                                <td>{{$result->point}}</td>
                                <td><span class="badge badge-success">{{$result->correct}}</span></td>
                                <td><span class="badge badge-danger">{{$result->wrong}}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            </p>
        </div>
    </div>
</x-app-layout>
