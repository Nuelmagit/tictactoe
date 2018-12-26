<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\TicTacToe\Repository\MatchRepository;
use App\Models\Match;
use App\TicTacToe\MatchAnalizer\MatchAnalizerInterface;
use Illuminate\Database\Eloquent\Collection;

class MatchRepositoryTest extends TestCase {

    private $matchRepository;
    private $testMatch;

    public function setUp() {
        parent::setUp();
        $matchAnalizer = $this->app->make(MatchAnalizerInterface::class);
        $this->matchRepository = new MatchRepository(new Match(), $matchAnalizer);
        $this->testMatch = $this->matchRepository->createMatch(Match::BEST_OF_THREE, 
                [0, 1, 1, 2, 2, 0, 0, 0, 0]
        );
    }

    public function tearDown() {
        $this->matchRepository->deleteMatchById($this->testMatch->id);
    }

    public function testFindAllMatches() {
        $matches = $this->matchRepository->findAllMatches();

        $this->assertInstanceOf(Collection::class, $matches);

        $this->assertGreaterThanOrEqual(1, $matches->count());
    }

    public function testFindMatchById() {

        $match = $this->matchRepository->findMatchById($this->testMatch->id);
        $this->assertEquals($this->testMatch->id, $match->id);
    }

    public function testMoveMatchById() {
        $current_player = $this->testMatch->next;
        $match_edited = $this->matchRepository->moveMatchById($this->testMatch->id, 0);
        $this->assertEquals($this->testMatch->id, $match_edited->id);
        $this->assertEquals($match_edited->board[0], $current_player);
    }

    public function testBestOfThree() {
        $current_player = $this->testMatch->next;
        $match_edited = $this->matchRepository->moveMatchById($this->testMatch->id, 0);
        $this->assertEquals($this->testMatch->id, $match_edited->id);
        $this->assertEquals($this->testMatch->wins[$current_player], 1);
    }

}
