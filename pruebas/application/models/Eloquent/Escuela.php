<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**

 * Pregunta Model

 */
class Escuela extends Illuminate\Database\Eloquent\Model {

    protected $table = 'Escuelas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
}
