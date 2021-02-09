<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getImage(){
        $result = array();
        // $decos = DB::table('decorations')->value('nom_photo');
        
        $decos = DB::table('decorations')->pluck('nom_photo');
        foreach($decos as $deco){
            array_push($result,$deco);
        };
        return $result;

        
        // return view('home',['decos'=>$decos]);
        // return response()->json($decos);

        // echo $decos;
        // $decos->each(function($item,$key){
        //     echo $item;
        // });
    }
}
?>