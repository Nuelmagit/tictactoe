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

    public function getMatchWinner($board);

    public function getNext($current);
}
