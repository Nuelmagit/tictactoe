<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\TicTacToe\MatchAnalizer\BasicMatchAnalizer;

class BasicMatchAnalizerTest extends TestCase {

    private $matchAnalizer;
    private $xWinnerBoard;
    private $oWinnerBoard;
    private $noneWinnerBoard;
    private $emptyBoard;

    public function setUp() {

        parent::setUp();
        $this->matchAnalizer = new BasicMatchAnalizer();
        $this->xWinnerBoard = [1, 1, 1, 2, 2, 0, 0, 0, 0];
        $this->oWinnerBoard = [0, 0, 0, 0, 1, 1, 2, 2, 2];
        $this->noneWinnerBoard = [1, 2, 1, 1, 1, 2, 2, 1, 2];
        $this->emptyBoard = [0, 0, 0, 0, 0, 0, 0, 0];
    }

    public function testMatchWinnerX() {
        $winner_x = $this->matchAnalizer->getMatchWinner($this->xWinnerBoard);
        $this->assertEquals($winner_x, BasicMatchAnalizer::PLAYER_X);
    }

    public function testMatchWinnerO() {
        $winner_x = $this->matchAnalizer->getMatchWinner($this->oWinnerBoard);
        $this->assertEquals($winner_x, BasicMatchAnalizer::PLAYER_O);
    }

    public function testGetNextPlayerX() {
        $next = $this->matchAnalizer->getNext(BasicMatchAnalizer::PLAYER_O);
        $this->assertEquals($next, BasicMatchAnalizer::PLAYER_X);
    }

    public function testGetNextPlayerO() {
        $next = $this->matchAnalizer->getNext(BasicMatchAnalizer::PLAYER_X);
        $this->assertEquals($next, BasicMatchAnalizer::PLAYER_O);
    }

    public function testHasMinimalMovements() {
        $resultEmptyBoard = $this->callInaccessibleMethod($this->matchAnalizer, 'hasMinimalMovements', [$this->emptyBoard]);
        $this->assertFalse($resultEmptyBoard);

        $resultNoneWinnerBoard = $this->callInaccessibleMethod($this->matchAnalizer, 'hasMinimalMovements', [$this->noneWinnerBoard]);
        $this->assertTrue($resultNoneWinnerBoard);
    }

    public function testWinnerInLine() {
        $winer = $this->callInaccessibleMethod($this->matchAnalizer, 'getWinnerInLine', [[1, 1, 1]]);
        $this->assertEquals($winer, BasicMatchAnalizer::PLAYER_X);
    }

    public function testWinnerInColumnOrRow() {
        $winer = $this->callInaccessibleMethod($this->matchAnalizer, 'getWinnerInColumnOrRow', [$this->xWinnerBoard]);
        $this->assertEquals($winer, BasicMatchAnalizer::PLAYER_X);
    }

    public function testWinnerInDiagonals() {
        $winer = $this->callInaccessibleMethod($this->matchAnalizer, 'getWinnerInDiagonals', [$this->xWinnerBoard]);
        $this->assertFalse($winer);
    }

}
