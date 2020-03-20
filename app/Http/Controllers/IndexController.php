<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class IndexController extends Controller
{
    public function __construct(){
        // $this->middleware('check.permission');
    }
    function index(Request $req){
        // print_r(dd(session()->get('member'))));
        if(request()->route('id')!=null){
           if(request()->route('id')==1){
            session()->put('permission',1);
            }else{
                session()->put('permission',0);
            }
        }

         return view('index');
    }
}
