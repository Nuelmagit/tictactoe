<?php

namespace Tests\Unit;

use Tests\TestCase;

class MatchControllerTest extends TestCase {

    public function testCreateMatches() {
        $response = $this->json('POST', '/api/match');
        $response->assertStatus(201);
    }

    public function testGetMatches() {
        $response = $this->json('GET', '/api/match');
        $response->assertStatus(200);
    }

    public function testGetMatch() {
        $response = $this->json('GET', '/api/match');
        $math = last($response->getData());
        $response_match = $this->json('GET', "/api/match/{$math->id}");
        $response_match->assertStatus(200);
    }

    public function testMakeMove() {
        $response = $this->json('GET', '/api/match');
        $math = last($response->getData());
        $response_move = $this->json('PUT', "/api/match/{$math->id}", ['position' => 5]);
        $match_moved = $response_move->getData();

        $this->assertEquals($math->id, $match_moved->id);
        $response_move->assertStatus(200);
    }

    public function testDeleteMatch() {
        $response = $this->json('GET', '/api/match');
        $math = last($response->getData());
        $response_delete = $this->json('DELETE', "/api/match/{$math->id}");
        $response_delete->assertStatus(200);
    }

}
