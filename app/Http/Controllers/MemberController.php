<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
class MemberController extends Controller
{
    function index(){
        if(session()->has('member'))
            return redirect('/');
         return view('login');
    }
    function login(){
        if(session()->has('member'))
            return redirect('/');
         return view('login');
    }
    function checkLogin(Request $req){
        $username = $req->get('username');
        $password = $req->get('password');
        if($username!=null&&$password!=null){
            $member = Member::memberKU( $username,$password);
            if($member!=null){
                session()->put("member", ['id'=>$member->id,'username'=>$member->username,'thainame'=>$member->thainame,'Admin'=>$member->isAdmin,
                        'mail1'=>$member->email1,'mail2'=>$member->email2,'firstname'=>$member->firstName,'lastname'=>$member->lastName
                        ,'permission'=>$member->permission,'faculty'=>$member->faculty,'department'=>$member->department]);
                        session()->put("icon",$member->icon);
                        print_r(session()->get("icon"));
                        session()->put("mail2",$member->email2);
                        if($member->isAdmin == 1)
                            session()->put("permission",1);
                        else session()->put("permission",0);
                        return redirect("/");
            }
            else{
                $msg = "ชื่อผู้ใช้หรือรหัสผ่านคุณผิด";
                return view("login", array('msg' => $msg));
            }
        }
        else{
            $msg = "คุณต้องกรอกชื่อผู้ใช้และรหัสผ่าน";
            return view("login", array('msg' => $msg));
        }
    }
    function logout(){
        session()->flush();
        return redirect('login');
    }
    function showProfile(){
        return view('profile');
    }
    public function updateIcon(Request $req){
        $username = session()->get('member')['username'];
        $dataI = $req->get('icon');
        $img_array = explode(';',$dataI);
        $img_array2 = explode(",",$img_array[1]);
        $dataI = base64_decode($img_array2[1]);
        $Icon = time().'.png';
        $path = "img/profile/$username";
        if(!file_exists($path))
            mkdir($path);
        $path .= "/$Icon";
        file_put_contents($path,$dataI);

        Member::where('username',$username)->update(['icon' => $path]);
        session()->put('icon',$path);
        return $path;
    }
    public function updateEmail(Request $req){
        $username = session()->get('member')['username'];
        $mail = $req->get('mail');
        $update = Member::where('username',$username)->update(['email2' => $mail]);
        session()->put("mail2",$mail);
        return $update;
    }
}
