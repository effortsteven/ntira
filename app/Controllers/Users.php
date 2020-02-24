<?php
namespace Controllers;
use Models\User;
class Users{

    public static function create_user($username){
        $user = User::create([
            'name' => $username,
        ]);
        return $user;
    }

    public static function get_all_user(){
        $users = User::all();
        return $users;
    }
}
?>