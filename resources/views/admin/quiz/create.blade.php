<x-app-layout>
    <x-slot name="header">
        Quiz Oluştur
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('quizzes.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Quiz Başlığı</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="">Quiz Açıklaması</label>
                    <textarea  class="form-control" name="description" cols="30" rows="4">{{ old('description') }}</textarea>
                </div>
                <div  class="form-group">
                    <input type="checkbox" @if(old('finished_at')) checked @endif ; id="isFinished" name="">
                    <label for="isFinished">Quiz Bitiş Tarihi Olacak Mı?</label>
                </div>
                <div @if(!old('finished_at')) style="display: none;"  @endif  id="finishInput" class="form-group">
                    <label for="">Quiz Bitiş Tarihi</label>
                    <input type="datetime-local" value="{{ old('finished_at') }}" class="form-control" name="finished_at">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block" type="submit" name="">Quiz Oluştur</button>
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
