<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "users";
    public $timestamps = false;

    public function borrowingLists()
    {
        return $this->belongsTo('App\BorrowingList');
    }
    public function alerts()
    {
        return $this->belongsTo('App\Alert');
    }

    public static function memberKU($username,$password){
        if($password!=null){
            $uri = "http://158.108.207.4/se62_01/ldap.php?username=$username&password=$password";
            $response = \Httpful\Request::get($uri)->send();
            $member_ku = json_decode($response, true);
            return self::createMember($member_ku,$username);
        }

        return null;
    }
    public static function  getMemberByThainame($name){
        $uri = "http://158.108.207.4/se62_01/ldap.php?thainame=b6021654145";
        $response = \Httpful\Request::get($uri)->send();
        $member_ku = json_decode($response, true);
        return self::createMember($member_ku,"b6021654145");
    }
    static  function  createMember($member_ku,$username){
        if($member_ku!=''){
            $member = Member::where("username","=",$username);
            if($member->get()->count() == 0){
                $member = new Member;
                $member->username = $member_ku['uid'][0];

                $member->thainame = $member_ku['first-name'][0];
                $member->firstName = $member_ku['first-name'][0];
                $member->lastName = $member_ku['last-name'][0];
                if($member_ku['type-person'][0] == 3){
                $member->department = $member_ku['major-id'][0];
                    $member->permission = "Student";
                }
                else{
                    $member->department = $member_ku['department'][0];
                    if($member_ku['type-person'][0] == 1)
                        $member->permission = "Teacher";
                    else
                        $member->permission = "Other";
                }
                $member->faculty = $member_ku['faculty'][0];

                $member->email1 = $member_ku['google-mail'][0];
                $member->icon = "img/avatar.png";
                $member->save();

                $member = Member::find($member->id);
            } else $member = $member->first();
            return $member;
        }
    }




}
