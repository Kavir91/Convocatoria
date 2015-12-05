<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aspirante extends Illuminate\Database\Eloquent\Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aspirante';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
    
    public function findbyidUser($id){
        $asp= Aspirante::where('idUser', '=', $id)->get();
        return $asp->first();
    }
}