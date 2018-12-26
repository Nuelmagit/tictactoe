<?php

namespace App\TicTacToe\Repository;

use Illuminate\Database\Eloquent\Model;
use App\TicTacToe\MatchAnalizer\MatchAnalizerInterface;
use App\Models\Match;

/**
 * Description of MatchRepository
 *
 * @author manuel
 */
class MatchRepository implements MatchRepositoryInterface {

    protected $matchModel;
    protected $matchAnalizer;

    const EMPTY_BOARD = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    public function __construct(Model $matchModel, MatchAnalizerInterface $matchAnalizer) {
        $this->matchModel = $matchModel;
        $this->matchAnalizer = $matchAnalizer;
    }

    public function findAllMatches() {
        return $this->matchModel->all();
    }

    public function createMatch($type = Match::BEST_OF_THREE, $board = self::EMPTY_BOARD) {
        $this->matchModel->winner = 0;
        $this->matchModel->next = 1;
        $this->matchModel->type = $type;
        $this->matchModel->board = $board;
        $this->matchModel->wins = MatchAnalizerInterface::WINS;
        $this->matchModel->save();
        return $this->matchModel;
    }

    public function findMatchById($macthId) {
        return $this->matchModel->find($macthId);
    }

    public function moveMatchById($macthId, $position) {
        $macth = $this->findMatchById($macthId);
        if ($macth->winner === MatchAnalizerInterface::EMPTY_PLACE &&
                $macth->board[$position] === MatchAnalizerInterface::EMPTY_PLACE) {
            $this->makeMove($macth, $position);
            $this->analizeWins($macth);
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

    private function analizeWins($match) {
        $match_freshed = $match->fresh();
        $modelWins = $match_freshed->wins;
        if ($match_freshed->type === Match::CLASIC) {
            return;
        }

        if (!in_array($match_freshed->winner, MatchAnalizerInterface::PLAYERS_IN_GAME)) {
            return;
        }

        if ($modelWins[$match_freshed->winner] === 2) {
            return;
        }

        $modelWins[$match_freshed->winner] ++;
        $match_freshed->wins = $modelWins;
        $match_freshed->board = self::EMPTY_BOARD;
        $match_freshed->winner = MatchAnalizerInterface::EMPTY_PLACE;
        $match_freshed->next = MatchAnalizerInterface::PLAYER_X;
        $match_freshed->save();
    }

}
