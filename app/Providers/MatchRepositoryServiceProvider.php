<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TicTacToe\Repository\MatchRepository;
use App\TicTacToe\Repository\MatchRepositoryInterface;
use App\Models\Match;
use App\TicTacToe\MatchAnalizer\MatchAnalizerInterface;

/**
 * Description of MatchAnalizerServiceProvider
 *
 * @author manuel
 */
class MatchRepositoryServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton(MatchRepositoryInterface::class, function ($app) {
            return new MatchRepository(new Match(), $app->make(MatchAnalizerInterface::class));
        });
    }

}
