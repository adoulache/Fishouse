<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $result = array();

        $decos = DB::table('decorations')->select(['description','nom_photo']);
        foreach($decos as $deco){
            array_push($result,$deco);
        };

        return view('home', ['decos' => $result]);
    }

    public function exempleAjax(){
        return "test OK!";
    }
}
?>
