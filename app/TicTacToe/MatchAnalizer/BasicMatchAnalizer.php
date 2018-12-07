<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\TicTacToe\MatchAnalizer;

/**
 * Description of BasicMatchAnalizer
 *
 * @author manuel
 */
class BasicMatchAnalizer implements MatchAnalizerInterface {

    CONST PLAYER_X = 1;
    CONST PLAYER_O = 2;
    CONST EMPTY_PLACE = 0;

    public function getMatchWinner($board) {
        if (!$this->hasMinimalMovements($board)) {
            return self::EMPTY_PLACE;
        }

        if ($winner_in_diagonal = $this->getWinnerInDiagonals($board)) {
            return $winner_in_diagonal;
        }

        if ($winner_in_row_column = $this->getWinnerInColumnOrRow($board)) {
            return $winner_in_row_column;
        }

        return self::EMPTY_PLACE;
    }

    public function getNext($current) {
        switch ($current) {
            case self::PLAYER_X:
                return self::PLAYER_O;
                break;
            case self::PLAYER_O:
                return self::PLAYER_X;
                break;
            default:
                return self::PLAYER_X;
        }
    }

    private function hasMinimalMovements($board) {
        $count_values_in_board = array_count_values($board);
        if (!isset($count_values_in_board[self::EMPTY_PLACE])) {
            return true;
        }
        if ($count_values_in_board[self::EMPTY_PLACE] <= 4) {
            return true;
        }
        return false;
    }

    private function getWinnerInDiagonals($board) {
        $first_diagonal = [$board[0], $board[4], $board[8]];
        $second_diagonal = [$board[2], $board[4], $board[6]];

        if ($winner = $this->getWinnerInLine($first_diagonal)) {
            return $winner;
        }

        return $this->getWinnerInLine($second_diagonal);
    }

    private function getWinnerInColumnOrRow($board) {
        $board_vector = array_chunk($board, 3);

        for ($position = 0; $position <= 2; $position++) {
            $row = $board_vector[$position];
            $column = array_column($board_vector, $position);

            if ($winner_in_row = $this->getWinnerInLine($row)) {
                return $winner_in_row;
            }
            if ($winner_in_column = $this->getWinnerInLine($column)) {
                return $winner_in_column;
            }
        }
        return false;
    }

    private function getWinnerInLine($board_line) {
        $players_in_game = [self::PLAYER_X, self::PLAYER_O];
        $pieces_in_line = array_count_values($board_line);
        $winner_in_line = array_search(3, $pieces_in_line);

        if (in_array($winner_in_line, $players_in_game)) {
            return $winner_in_line;
        }

        return false;
    }

}
