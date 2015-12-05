<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EscuelaProcedencia extends Illuminate\Database\Eloquent\Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'escueladeprocedencia';
    protected $primaryKey = 'esc_id';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = array('password', 'remember_token');

    public function buscar($municipio, $sector, $turno) {
        //Para el turno
        //Si el turno es 1, es matutina
        //Si el turno es 2, es vespertina
        //De lo contrario, es OTRO
        //
        //Para el sector//{T,P,E,F,0}
        //Si es "E" o "F", es publico
        //Si es "P", es privado
        //De lo contrario, es OTRO
        $escuelas = [];

        if ($municipio != false && $sector != false && $turno != false) {
            if ($sector == "PRIVADO" && $turno == "MATUTINO") {
                //echo "<br>" . "1. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where('esc_sectorescuela', '=', 'P')
                        ->where('esc_turno', '=', '1')
                        ->get();
                //select * from "escueladeprocedencia" where "esc_municipio" = ? and "esc_sectorescuela" = ? and "esc_turno" = ?
            } else if ($sector == "PRIVADO" && $turno == "VESPERTINO") {
                //echo "<br>" . "2. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where('esc_sectorescuela', '=', 'P')
                        ->where('esc_turno', '=', '2')
                        ->get();
                //select * from "escueladeprocedencia" where "esc_municipio" = ? and "esc_sectorescuela" = ? and "esc_turno" = ?
            } else if ($sector == "PRIVADO" && $turno == "OTRO") {
                //echo "<br>" . "3. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where('esc_sectorescuela', '=', 'P')
                        ->where(function($query) {
                            $query->where('esc_turno', '<>', '1')
                            ->where('esc_turno', '<>', '2');
                        })
                        ->get();
                        //select * from "escueladeprocedencia" where "esc_municipio" = ? and "esc_sectorescuela" = ? and ("esc_turno" <> ? and "esc_turno" <> ?)
            } else if ($sector == "PUBLICO" && $turno == "MATUTINO") {
                //echo "<br>" . "4. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where(function($query) {
                            $query->orwhere('esc_sectorescuela', '=', 'E')
                            ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                        })
                        ->where('esc_turno', '=', '1')
                        ->get();
                        //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" = ? or "esc_sectorescuela" = ?) and "esc_turno" = ?
            } else if ($sector == "PUBLICO" && $turno == "VESPERTINO") {
                //echo "<br>" . "5. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where(function($query) {
                            $query->where('esc_sectorescuela', '=', 'E')
                            ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                        })
                        ->where('esc_turno', '=', '2')
                        ->get();
                        //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" = ? or "esc_sectorescuela" = ?) and "esc_turno" = ?
            } else if ($sector == "PUBLICO" && $turno == "OTRO") {
                //echo "<br>" . "6. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where(function($query) {
                            $query->where('esc_sectorescuela', '=', 'E')
                            ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                        })
                        ->where(function($query) {
                            $query->where('esc_turno', '<>', '1')
                            ->where('esc_turno', '<>', '2');
                        })
                        ->get();
                        //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" = ? or "esc_sectorescuela" = ?) and ("esc_turno" <> ? and "esc_turno" <> ?)
            } else if ($sector == "OTRO" && $turno == "MATUTINO") {
                //echo "<br>" . "7. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where(function($query) {
                            $query->where('esc_sectorescuela', '<>', 'E')
                            ->where('esc_sectorescuela', '<>', 'F')
                            ->where('esc_sectorescuela', '<>', 'P');
                        })
                        ->where('esc_turno', '=', '1')
                        ->get();
                        //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?) and "esc_turno" = ?
            } else if ($sector == "OTRO" && $turno == "VESPERTINO") {
                //echo "<br>" . "8. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where(function($query) {
                            $query->where('esc_sectorescuela', '<>', 'E')
                            ->where('esc_sectorescuela', '<>', 'F')
                            ->where('esc_sectorescuela', '<>', 'P');
                        })
                        ->where('esc_turno', '=', '2')
                        ->get();
                        //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?) and "esc_turno" = ?
            } else if ($sector == "OTRO" && $turno == "OTRO") {
                //echo "<br>" . "9. ";//CORRECTO
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->Where(function($query) {
                            $query->where('esc_sectorescuela', '<>', 'E')
                            ->where('esc_sectorescuela', '<>', 'F')
                            ->where('esc_sectorescuela', '<>', 'P');
                        })
                        ->where(function($query) {
                            $query->where('esc_turno', '<>', '1')
                            ->where('esc_turno', '<>', '2');
                        })
                        ->get();
                        //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?) and ("esc_turno" <> ? and "esc_turno" <> ?)
            }
        } else {//////////////////////////////////////////////////////////////////////////////////////////////////
            if ($municipio != false && $sector != false) {
                if ($sector == "PUBLICO") {
                    //echo "<br>" . "10. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                            ->Where(function($query) {
                                $query->orwhere('esc_sectorescuela', '=', 'E')
                                ->orwhere('esc_sectorescuela', '=', 'F');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" = ? or "esc_sectorescuela" = ?)
                } else if ($sector == "PRIVADO") {
                    //echo "<br>" . "11. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                            ->Where('esc_sectorescuela', '=', 'P')
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_municipio" = ? and "esc_sectorescuela" = ?
                } else if ($sector == "OTRO") {
                    //echo "<br>" . "12. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                            ->Where(function($query) {
                                $query->where('esc_sectorescuela', '<>', 'E')
                                ->where('esc_sectorescuela', '<>', 'F')
                                ->where('esc_sectorescuela', '<>', 'P');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?)
                }
            } else
            if ($municipio != false && $turno != false) {
                if ($turno == "MATUTINO") {
                    //echo "<br>" . "13. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                            ->Where('esc_turno', '=', '1')
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_municipio" = ? and "esc_turno" = ?
                } else if ($turno == "VESPERTINO") {
                    //echo "<br>" . "14. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                            ->Where('esc_turno', '=', '2')
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_municipio" = ? and "esc_turno" = ?
                } else if ($turno == "OTRO") {
                    //echo "<br>" . "15. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                            ->Where(function($query) {
                                $query->where('esc_turno', '<>', '1')
                                ->where('esc_turno', '<>', '2');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where "esc_municipio" = ? and ("esc_turno" <> ? and "esc_turno" <> ?)
                }
            } else
            if ($sector != false && $turno != false) {
                if ($sector == "PRIVADO" && $turno == "MATUTINO") {
                    //echo "<br>" . "16. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where('esc_sectorescuela', '=', 'P')
                            ->where('esc_turno', '=', '1')
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_sectorescuela" = ? and "esc_turno" = ?
                } else if ($sector == "PRIVADO" && $turno == "VESPERTINO") {
                    //echo "<br>" . "17. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where('esc_sectorescuela', '=', 'P')
                            ->where('esc_turno', '=', '2')
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_sectorescuela" = ? and "esc_turno" = ?
                } else if ($sector == "PRIVADO" && $turno == "OTRO") {
                    //echo "<br>" . "18. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where('esc_sectorescuela', '=', 'P')
                            ->where(function($query) {
                                $query->where('esc_turno', '<>', '1')
                                ->where('esc_turno', '<>', '2');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where "esc_sectorescuela" = ? and ("esc_turno" <> ? and "esc_turno" <> ?)
                } else if ($sector == "PUBLICO" && $turno == "MATUTINO") {
                    //echo "<br>" . "19. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where(function($query) {
                                $query->orwhere('esc_sectorescuela', '=', 'E')
                                ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                            })
                            ->where('esc_turno', '=', '1')
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_sectorescuela" = ? or "esc_sectorescuela" = ?) and "esc_turno" = ?
                } else if ($sector == "PUBLICO" && $turno == "VESPERTINO") {
                    //echo "<br>" . "20. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where(function($query) {
                                $query->where('esc_sectorescuela', '=', 'E')
                                ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                            })
                            ->where('esc_turno', '=', '2')
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_sectorescuela" = ? or "esc_sectorescuela" = ?) and "esc_turno" = ?
                } else if ($sector == "PUBLICO" && $turno == "OTRO") {
                    //echo "<br>" . "21. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where(function($query) {
                                $query->where('esc_sectorescuela', '=', 'E')
                                ->orwhere('esc_sectorescuela', '=', 'F'); //interntar con orwhere
                            })
                            ->where(function($query) {
                                $query->where('esc_turno', '<>', '1')
                                ->where('esc_turno', '<>', '2');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_sectorescuela" = ? or "esc_sectorescuela" = ?) and ("esc_turno" <> ? and "esc_turno" <> ?)
                } else if ($sector == "OTRO" && $turno == "MATUTINO") {
                    //echo "<br>" . "22. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where(function($query) {
                                $query->where('esc_sectorescuela', '<>', 'E')
                                ->where('esc_sectorescuela', '<>', 'F')
                                ->where('esc_sectorescuela', '<>', 'P');
                            })
                            ->where('esc_turno', '=', '1')
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?) and "esc_turno" = ?
                } else if ($sector == "OTRO" && $turno == "VESPERTINO") {
                    //echo "<br>" . "23. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where(function($query) {
                                $query->where('esc_sectorescuela', '<>', 'E')
                                ->where('esc_sectorescuela', '<>', 'F')
                                ->where('esc_sectorescuela', '<>', 'P');
                            })
                            ->where('esc_turno', '=', '2')
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?) and "esc_turno" = ?
                } else if ($sector == "OTRO" && $turno == "OTRO") {
                    //echo "<br>" . "24. "; //CORRECTO
                    $escuelas = EscuelaProcedencia::Where(function($query) {
                                $query->where('esc_sectorescuela', '<>', 'E')
                                ->where('esc_sectorescuela', '<>', 'F')
                                ->where('esc_sectorescuela', '<>', 'P');
                            })
                            ->where(function($query) {
                                $query->where('esc_turno', '<>', '1')
                                ->where('esc_turno', '<>', '2');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?) and ("esc_turno" <> ? and "esc_turno" <> ?)
                }
            } else
            if ($sector != false) {
                if ($sector == "PRIVADO") {
                    //echo "<br>" . "25. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_sectorescuela', '=', "P")
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_sectorescuela" = ?
                } else if ($sector == "PUBLICO") {
                    //echo "<br>" . "26. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_sectorescuela', '=', 'E')
                            ->orwhere('esc_sectorescuela', '=', 'F')
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_sectorescuela" = ? or "esc_sectorescuela" = ?
                } else if ($sector == "OTRO") {
                    //echo "<br>" . "27. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where(function($query) {
                                $query->where('esc_sectorescuela', '<>', 'E')
                                ->where('esc_sectorescuela', '<>', 'F')
                                ->where('esc_sectorescuela', '<>', 'P');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_sectorescuela" <> ? and "esc_sectorescuela" <> ? and "esc_sectorescuela" <> ?)
                }
            } else
            if ($turno != false) {
                if ($turno == "MATUTINO") {
                    //echo "<br>" . "28. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_turno', '=', 1)
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_turno" = ?
                } else if ($turno == "VESPERTINO") {
                    //echo "<br>" . "29. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where('esc_turno', '=', 2)
                            ->get();
                    //select * from "escueladeprocedencia" where "esc_turno" = ?
                } else if ($turno == "OTRO") {
                    //echo "<br>" . "30. ";//CORRECTO
                    $escuelas = EscuelaProcedencia::where(function($query) {
                                $query->where('esc_turno', '<>', '1')
                                ->where('esc_turno', '<>', '2');
                            })
                            ->get();
                            //select * from "escueladeprocedencia" where ("esc_turno" <> ? and "esc_turno" <> ?)
                }
            } else
            if ($municipio != false) {
                $escuelas = EscuelaProcedencia::where('esc_municipio', '=', $municipio)
                        ->get();
                //select * from "escueladeprocedencia" where "esc_municipio" = ?
            }
        }
        return $escuelas;
    }

}
