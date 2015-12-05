<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Illuminate\Database\Eloquent\Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    
    public function Auth($login, $passw) {
        $user = User::where('login', '=', $login)
                ->where('password', '=', $passw)
                ->get();
        return $user->first();
    }

}
