<?php

namespace App\Controllers;

class WebsiteController extends BaseController
{
    public function home()
    {
        $data['content'] = view('website/index');
        return view('website/header', $data);
    }
    public function produk()
    {
        $data['content'] = view('website/produk');
        return view('website/header', $data);
    }
    public function detailProduk()
    {
        $data['content'] = view('website/detail-produk');
        return view('website/header', $data);
    }
}
