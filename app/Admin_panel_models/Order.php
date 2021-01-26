<?php

namespace App\Admin_panel_models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Order extends Model
{
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Метод проверяет наличие активного ключа столика в куках пользоваеля.
     *
     * Если метод возвращает 0 - значит у пользователя в куках либо нет ключа, либо указан несуществующий ключ.
     * Если метод возвращает 1 - значит у пользователя в куках есть активный ключ.
     *
     * @return bool
     */
    static function hasKey() : bool
    {
        return self::where('key', Cookie::get('table_key'))->count();
    }
}
