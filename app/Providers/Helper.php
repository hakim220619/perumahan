<?php

namespace App\Providers;

use Request;
use Illuminate\Support\Facades\DB;


class Helper
{
    static public function apk()
    {
        $apk = DB::table('aplikasi')->first();
        // dd($apk);
        return $apk;
    }
}
