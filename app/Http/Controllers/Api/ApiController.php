<?php

namespace App\Http\Controllers\Api;

use App\client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public  function  simpan(Request $request)
    {
        $simpan = client::create([
            "nama" => $request->name
        ]);

        return $simpan;
    }
}
