<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Colonia extends Illuminate\Database\Eloquent\Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colonias';
    protected $primaryKey = 'col_id';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('col_claveestado', 'col_nombreestado',);
        
    }
