<?php

namespace App\Services;

use App\Admin_panel_models\Product;
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
    public $orders = [];

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

    /**
     * Метод меняет количество заказанного продукта.
     *
     * @param $id
     * @param $quantity
     */
    public function changeQuantity($id, $quantity)
    {
        $this->orders[$id] = (array)$quantity;
        Cookie::queue('orders', serialize($this->orders), 480);
    }

    /**
     * Метод возвращает полную стоимость итоговую сумму всех заказов корзины.
     *
     * @return float|int
     */
    public function totalPrice(): int
    {
        return array_sum(array_column($this->getOrdersWithProduct(), 'fullPrice'));
    }

    /**
     * Убирает продукт из корзины.
     *
     * @param $id
     */
    public function unsetProduct($id)
    {
        unset($this->orders[$id]);
        Cookie::queue('orders', serialize($this->orders), 480);
    }

    /**
     * Метод берет корзину из cookies пользователя, и к каждой позиции подтягивает продукт, и его полную цену.
     *
     */
    public function getOrdersWithProduct()
    {
        $orders = $this->orders;

        foreach ($orders as $product_id => $quantity) {
            $product = Product::find($product_id);

            $orders[$product_id] = $quantity;
            $orders[$product_id]['product'] = $product;
            $orders[$product_id]['fullPrice'] = (integer)$orders[$product_id][0] * $product->price;
        }

        return $orders;
    }
}
