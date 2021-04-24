<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'finished_at'
    ];

    /**
     * Carbon sinifini istedigimiz tarih alani icin kullanmak icin eklememiz gereken kod ve degeri
     * diffForHumans() methodu icin yazfik. normalde bu method sadece created_at ve update_et icin laravel tarafinda olusturulmustur
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'finished_at'
    ];
    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date):null;
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
