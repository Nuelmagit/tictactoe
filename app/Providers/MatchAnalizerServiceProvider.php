<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TicTacToe\MatchAnalizer\BasicMatchAnalizer;
use App\TicTacToe\MatchAnalizer\MatchAnalizerInterface;

/**
 * Description of MatchAnalizerServiceProvider
 *
 * @author manuel
 */
class MatchAnalizerServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton(MatchAnalizerInterface::class, function ($app) {
            return new BasicMatchAnalizer();
        });
    }

}
