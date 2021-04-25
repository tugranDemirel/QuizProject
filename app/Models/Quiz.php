<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
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

    protected $appends = [
        'details',
    ];
/**
 * Quiz tablosuna sanal olarak yeni bir alan olusturduk. Alan olusturma islemini yaparken basina
 * get sonuna ise buyuk harfle baslayan Attribute yaziyoruz. Ikisinin ortasinda kalan kisim ise
 * bizim sanal olarak olusturdugumuz tablodaki alanimiz oluyor. Bu sanal alani kullabailmek icin
 * yukaridaki gibi appends icerisinde belirtioruz.
 * Verileri on yuzde kullanirken dizi seklinde kullaniyoruz.
 */
    public function getDetailsAttribute()
    {
        if ($this->results()->count() > 0) {
            return [
                /* asagida olusturdugum result fonksiyonunu kullanarak quize ait verileri geitrdim.*/
                'average' => round($this->results()->avg('point')),
                'join_count' => $this->results()->count()
            ];
        }

        return null;
    }

    public function results()
    {
        /* Quize ait tum  veririr*/
        return $this->hasMany('App\Models\Result');
    }

    public function topTen()
    {
        return $this->results()->orderByDesc('point')->limit(10);
    }

    public function my_result()
    {
        if(auth()->user()->id)
        {
            return $this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id);
        }
        return null;
    }

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date):null;
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'onUpdate' => true,

                'source' => 'title'
            ]
        ];
    }
}
