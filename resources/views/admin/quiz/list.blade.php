<x-app-layout>
    <x-slot name="header">
        Quiz Listeleme
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title float-right">
                <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus mr-1"></i>Quiz Oluştur</a>
            </h5>
            <form action="" method="GET">
                <div class="form-row">
                    <div class="col-md-2">
                        <input type="text" value="{{request()->get('title')}}" name="title" class="form-control" placeholder="Quiz Adı">
                    </div>
                    <div class="col-md-2">
                        <select name="status" onchange="this.form.submit()" id="" class="form-control">
                            <option >Durum Seç</option>
                            <option   value="publish">Aktif</option>
                            <option  value="passive">Pasif</option>
                            <option   value="draft">Taslak</option>
                        </select>
                    </div>
                    @if(request()->get('title') or request()->get('status'))
                        <div class="col-md-2">
                            <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Temizle</a>
                        </div>
                    @endif
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Quiz</th>
                    <th scope="col">Soru Sayısı</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Bitiş Tarihi</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quizzes as $quiz)
                <tr>
                    <td>{{$quiz->title}}</td>
                    <td>{{$quiz->questions_count}}</td>
                    <td>
                        @switch($quiz->status)
                            @case('publish')
                                <span class="badge badge-success">Aktif</span>
                                @break
                            @case('passive')
                                <span class="badge badge-danger">Pasif</span>
                                @break
                            @case('draft')
                            <span class="badge badge-warning">Taslak</span>
                            @break
                        @endswitch
                    </td>
                    <td>
                        <span title="{{$quiz->finished_at}}">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-'}}</span>
                    </td>
                    <td>
                        <a title="Ayrıntı" href="{{route('questions.index',$quiz->id)}}" class="btn btn-info"><i class="fa fa-question"></i></a>
                        <a title="Düzenle" href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a title="Sil" href="{{route('quizzes.destroy',$quiz->id)}}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            {{$quizzes->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
