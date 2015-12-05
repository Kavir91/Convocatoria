<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**

 * Pregunta Model

 */
class modelocarrera extends Illuminate\Database\Eloquent\Model {

    protected $table = 'carrera';
    protected $primaryKey = 'idcarrera';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}