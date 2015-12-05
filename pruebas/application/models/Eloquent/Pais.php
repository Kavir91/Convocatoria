<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pais extends Illuminate\Database\Eloquent\Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paises';
    protected $primaryKey = 'pai_id';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');
        
    }
