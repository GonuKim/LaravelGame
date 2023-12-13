<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gameList');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // 게임 점수 저장하기
    public function store(Request $request)
    {
    $point = $request->point;
    $game_name = $request->game_name;

    $user = Auth::user();
    
    // 게임 테이블에서 user_id와 game_name이 같은 데이터 찾기
    $existingGame = Game::where('user_id', $user->id)
                        ->where('game_name', $game_name)
                        ->first();

    // 찾은 데이터가 없거나 현재 점수가 더 높을 경우에만 저장
    if (!$existingGame || $point > $existingGame->point) {
        $game = new Game();
        $game->game_name = $game_name;
        $game->point = $point;
        $game->user_id = $user->id;

        $game->save();

        return redirect("/game/$game_name");
    } else {
        // 현재 점수가 더 낮을 경우에는 저장하지 않고 이전 페이지로 리디렉션
        return redirect("/game/$game_name");
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if($id==="ballGame"){
            return view('game');
        }
        if($id==="cardGame"){
            return view('game2');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
