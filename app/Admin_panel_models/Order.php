<?php

namespace App\Admin_panel_models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cookie;

class Order extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Каждый Order имеет множество Carts.
     *
     * @return HasMany
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Каждый Order пренадлежит Status.
     *
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Каждый Order пренадлежит Table.
     *
     * @return BelongsTo
     */
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * Каждый Order пренадлежит User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Каждый Order пренадлежит Invoice.
     *
     * @return BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
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

    /**
     * Метод проверяет наличие статуса Payment request в Order.
     *
     * @return bool
     */
    public function onPaymentRequest() : bool
    {
        return $this->status_id === 4;
    }

    /**
     * Создание массива со всеми необходимыми данными о продуктах в Order.
     *
     * Метод собирает в массив все продукты которые находятся в Order. Каждый полученный вложенный массив состоит из
     * следующих ключей: [`имя продукта`, `цена за единицу`, `количество`, `полная цена`, `состояние`].
     * Чтобы метод вернул продукты только с определенным состоянием - необходимо указать имя нужного состояния
     * в аргументе метода.
     *
     * @param null $condition
     * @return array
     */
    public function productArr($condition = null): array
    {
        foreach ($this->carts()->with('product')->get() as $product) {

            if (!is_null($condition) && $condition !== $product->condition->name) continue;

            $products[] = [
                'id' => $product->id,
                'name' => $product->product->name,
                'price' => $product->product->price,
                'quantity' => $product->quantity,
                'fullPrice' => $product->product->price * $product->quantity,
                'image' => $product->product->image,
                'condition' => $product->condition->name,
                'created_at'=> $product->created_at->timestamp
            ];
        }

        return $products ?? [];
    }

    /**
     * Метод проверяет, все ли Carts у данного Order находятся в статусе Accepted.
     *
     * @return bool
     */
    public function isAllCartsAccepted(): bool
    {

        foreach ($this->carts()->get() as $cart) {
            if ($cart->condition_id !== 2) return false;
        }

        return true;
    }

    /**
     * Метод возвращает Order по ключу в cookies.
     *
     * @return mixed
     */
    static function getOrderByCookiesKey()
    {
        return Order::where('key', request()->cookie('table_key'))->first();
    }
}
