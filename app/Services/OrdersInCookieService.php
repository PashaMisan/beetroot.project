<?php


namespace App\Services;


use Illuminate\Support\Facades\Cookie;

/**
 * Class OrdersInCookieService
 *
 * Класс предоставляет собой сервис для удобной работы с корзиной заказов, которая находится в куках пользователя
 *
 * @package App\Services
 */
class OrdersInCookieService
{
    /**
     * Содержит в себе все заказанные пользователем товары.
     *
     * @var array|mixed
     */
    private $orders = [];

    /**
     * Устанавливает или распаковыввает (если она существует) корзину пользователя из cookies.
     *
     * OrdersInCookieService constructor.
     */
    public function __construct()
    {
        $this->orders = (Cookie::has('orders')) ? unserialize(Cookie::get('orders')) : [];
    }

    /**
     * Добавляет товар в корзину пользователя.
     *
     * @param array $data
     */
    public function addToCart(array $data): void
    {
        $this->orders[$data['product_id']] =(array) $data['quantity'];
        Cookie::queue('orders', serialize($this->orders), 480);
    }
}
