<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function ajax()
    {
        $positions = Position::all();
        return response()->json($positions);
    }

    public function index(): View
    {
        $positions = Position::all();

        return view('position.index', compact('positions'));
    }
}
