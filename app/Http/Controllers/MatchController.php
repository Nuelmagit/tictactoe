<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\TicTacToe\Repository\MatchRepositoryInterface;

class MatchController extends Controller {

    private $matchRepository;

    public function __construct(MatchRepositoryInterface $matchRepository) {
        $this->matchRepository = $matchRepository;
    }

    public function index() {
        return view('index');
    }

    /**
     * Returns a list of matches
     *
     * TODO it's mocked, make this work :)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function matches() {
        return response()->json($this->matchRepository->findAllMatches()->toArray());
    }

    /**
     * Returns the state of a single match
     *
     * TODO it's mocked, make this work :)
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function match($id) {
        return response()->json($this->matchRepository->findMatchById($id)->toArray());
    }

    /**
     * Makes a move in a match
     *
     * TODO it's mocked, make this work :)
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function move($id) {
        $position = Input::get('position');
        return response()->json($this->matchRepository->moveMatchById($id, $position));
    }

    /**
     * Creates a new match and returns the new list of matches
     *
     * TODO it's mocked, make this work :)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create() {
        $this->matchRepository->createMatch();
        return response()->json($this->matchRepository->findAllMatches()->toArray(), 201);
    }

    /**
     * Deletes the match and returns the new list of matches
     *
     * TODO it's mocked, make this work :)
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id) {
        $this->matchRepository->deleteMatchById($id);
        return response()->json($this->matchRepository->findAllMatches()->toArray());
    }

}
