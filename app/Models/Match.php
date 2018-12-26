<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Match
 *
 * @author manuel
 */
class Match extends Model {

    CONST CLASIC = 1;
    CONST BEST_OF_THREE = 2;

    public $timestamps = false;
    protected $table = 'match';
    protected $casts = ['board' => 'array', 'wins' => 'array'];
    protected $appends = ['name'];

    function getNameAttribute() {
        return 'Match #' . $this->id;
    }

}
