<?php

namespace App\Utils;

use  LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Facades\Auth;

class QRCodeUtils
{


    public function gerar(string $id = 'regis')
    {

        // dd(file_get_contents(QRCode::text("{Id:".Auth::user()->origem_id. "}")
        // ->setSize(8)
        // ->setMargin(2)
        // ->png())); 

        return 'fsdfsd';
        return  file_get_contents(QRCode::text("{Id:" . $id . "}")
            ->setSize(8)
            ->setMargin(2)
            ->png());



      

        dd(file_get_contents(QRCode::url('werneckbh.github.io/qr-code/')
            ->setSize(8)
            ->setMargin(2)
            ->svg()));

        dd(file_get_contents(QRCode::text('werneckbh.github.io/qr-code/')
            ->setSize(8)
            ->setMargin(2)
            ->svg()));

        return QRCode::text('Laravel QR Code Generator!')->png();
    }
}
