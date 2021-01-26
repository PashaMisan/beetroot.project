<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableKeyController extends Controller
{
    public function setKey()
    {
        if(!request('table_key')) {
            return redirect(route('menu'));
        }

        if(url()->previous() !== route('admin_panel_main')) {
            Cookie::queue('table_key', request('table_key'), 480);
            return redirect(route('menu'));
        }

        return view('showQR', [
            'qr' => QrCode::size(300)->margin(1)->backgroundColor(255, 255, 255, 50)->generate(url()->full()),
        ]);
    }
}
