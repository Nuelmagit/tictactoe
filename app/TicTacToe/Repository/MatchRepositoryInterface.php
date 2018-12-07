<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\TicTacToe\Repository;

/**
 *
 * @author manuel
 */
interface MatchRepositoryInterface {

    public function findAllMatches();

    public function createMatch();

    public function findMatchById($macthId);
    
    public function moveMatchById($macthId, $position);

    public function deleteMatchById($macthId);
}
