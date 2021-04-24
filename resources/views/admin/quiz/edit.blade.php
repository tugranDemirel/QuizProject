<x-app-layout>
    <x-slot name="header">
        Quiz Güncelle
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('quizzes.update', $quiz->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Quiz Başlığı</label>
                    <input type="text" class="form-control" name="title" value="{{$quiz->title}}">
                </div>
                <div class="form-group">
                    <label for="">Quiz Açıklaması</label>
                    <textarea  class="form-control" name="description" cols="30" rows="4">{{$quiz->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Quiz Durumu</label>
                    <select name="status" id="" class="form-control">
                        <option @if($quiz->questions_count <4) disabled @endif @if($quiz->status === 'publish') selected @endif value="publish">Aktif</option>
                        <option @if($quiz->status === 'passive') selected @endif value="passive">Pasif</option>
                        <option @if($quiz->status === 'draft') selected @endif value="draft">Taslak</option>
                    </select>
                </div>
                <div  class="form-group">
                    <input type="checkbox" @if($quiz->finished_at) checked @endif ; id="isFinished" name="">
                    <label for="isFinished">Quiz Bitiş Tarihi Olacak Mı?</label>
                </div>
                <div @if(!$quiz->finished_at) style="display: none;"  @endif  id="finishInput" class="form-group">
                    <label for="">Quiz Bitiş Tarihi</label>
                    <input type="datetime-local" @if($quiz->finished_at) value="{{date('Y-m-d\TH:i' ,strtotime($quiz->finished_at))}}" @endif class="form-control" name="finished_at">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block" type="submit" name="">Quiz Güncelle</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $('#isFinished').change(function (){
                //ilgili id e bagli form elemani secili mi ? Seciliyse
                if ($('#isFinished').is(':checked'))
                {
                    $('#finishInput').show();
                }
                else
                {
                    $('#finishInput').hide();
                }
            });
        </script>
    </x-slot>
</x-app-layout>
