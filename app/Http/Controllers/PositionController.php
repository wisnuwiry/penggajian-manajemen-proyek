<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
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
        $positions = Position::orderByDesc('created_at')->paginate(10);

        return view('position.index', compact('positions'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create() : View {
        return view('position.create');    
    }

    public function store(StorePositionRequest $request): RedirectResponse {
        try {
            Position::create($request->validated());
            return redirect()->route('position.index')->with('success', 'Position created successfully.');
        } catch (\Exception $e) {
            return back()
                    ->withInput()
                    ->withErrors('Failed to create position.');
        }
    }

    public function edit(Position $position): View {
        return view('position.edit', compact('position'));
    }

    public function update(UpdatePositionRequest $request, Position $position): RedirectResponse {
        try {
            $position->update($request->validated());
            return redirect()->route('position.index')->with('success', 'Position update successfully.');
        } catch (\Exception $e) {
            return back()
                    ->withInput()
                    ->withErrors('Failed to update position.');
        }
    }

    public function destroy(Position $position) {
        $position->delete();

        return to_route('position.index');
    }
}
