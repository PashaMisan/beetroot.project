<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Class TableKeyController
 * @package App\Http\Controllers\Admin_panel
 */
class TableKeyController extends Controller
{
    /**
     * Метод выводит QR код, отсканировав который устанавливается ключ столика в куках пользователя.
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function setKey()
    {
        // Проверка на наличие ключа столика в get запросе
        if(!request('table_key')) {
            return redirect(route('menu'));
        }

        // Если по этой ссылке зашли не из админ панели, то в куках устанавливается ключ столика
        if(url()->previous() !== route('admin_panel_main')) {
            Cookie::queue('table_key', request('table_key'), 480);
            return redirect(route('menu'));
        }

        return view('showQR', [
            'qr' => QrCode::size(300)->margin(1)->backgroundColor(255, 255, 255, 50)->generate(url()->full()),
        ]);
    }
}
