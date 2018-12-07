<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Description of CreateMatchTable
 *
 * @author manuel
 */
class CreateMatchTable extends Migration {

    public function up() {
        Schema::create('match', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('next');
            $table->integer('winner');
            $table->text('board');
        });
    }

    public function down() {
        Schema::dropIfExists('match');
    }

}
