<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\TicTacToe\MatchAnalizer;

/**
 *
 * @author manuel
 */
interface MatchAnalizerInterface {

    CONST PLAYER_X = 1;
    CONST PLAYER_O = 2;
    CONST EMPTY_PLACE = 0;
    CONST WINS = [self::PLAYER_X => 0, self::PLAYER_O => 0];
    CONST PLAYERS_IN_GAME = [self::PLAYER_X, self::PLAYER_O];

    public function getMatchWinner($board);

    public function getNext($current);
}
