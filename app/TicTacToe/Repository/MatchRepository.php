<?php

namespace App\TicTacToe\Repository;

use Illuminate\Database\Eloquent\Model;
use App\TicTacToe\MatchAnalizer\MatchAnalizerInterface;

/**
 * Description of MatchRepository
 *
 * @author manuel
 */
class MatchRepository implements MatchRepositoryInterface {

    protected $matchModel;
    protected $matchAnalizer;

    public function __construct(Model $matchModel, MatchAnalizerInterface $matchAnalizer) {
        $this->matchModel = $matchModel;
        $this->matchAnalizer = $matchAnalizer;
    }

    public function findAllMatches() {
        return $this->matchModel->all();
    }

    public function createMatch() {
        $this->matchModel->winner = 0;
        $this->matchModel->next = 1;
        $this->matchModel->board = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        $this->matchModel->save();
        return $this->matchModel;
    }

    public function findMatchById($macthId) {
        return $this->matchModel->find($macthId);
    }

    public function moveMatchById($macthId, $position) {
        $macth = $this->findMatchById($macthId);
        if ($macth->winner === 0 && $macth->board[$position] === 0) {
            $this->makeMove($macth, $position);
        }
        return $macth;
    }

    public function deleteMatchById($macthId) {
        return $this->matchModel->destroy($macthId);
    }

    private function makeMove($macth, $position) {
        $board = $macth->board;
        $board[$position] = $macth->next;
        $macth->board = $board;
        $macth->winner = $this->matchAnalizer->getMatchWinner($board);
        $macth->next = $this->matchAnalizer->getNext($macth->next);
        $macth->save();
    }

}
