<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index($nome="sss")
    {
        $users = DB::select('select * from estados');

        dd($users);

        // return 'Regis nuens Ssantos--->'.$nome;
    }

    //
}
