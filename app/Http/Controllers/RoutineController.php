<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Exercise;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function index()
    {
        $routines = Routine::where('user_id', auth()->id())->with('exercises')->get();
        return view('routines.index', compact('routines'));
    }

    public function create()
    {
        $exercises = Exercise::all();
        return view('routines.create', compact('exercises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'exercises' => 'required|array',
            'exercises.*' => 'exists:exercises,id',
            'sets_target' => 'required|array',
            'reps_target' => 'required|array',
        ]);

        $routine = Routine::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
        ]);

        foreach ($request->exercises as $index => $exerciseId) {
            $routine->exercises()->attach($exerciseId, [
                'sets_target' => $request->sets_target[$index],
                'reps_target' => $request->reps_target[$index],
            ]);
        }

        return redirect()->route('routines.index')->with('success', 'Routine created successfully!');
    }

    public function edit(Routine $routine)
    {
        $exercises = Exercise::all();
        return view('routines.edit', compact('routine', 'exercises'));
    }

    public function update(Request $request, Routine $routine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'exercises' => 'required|array',
            'exercises.*' => 'exists:exercises,id',
        ]);

        $routine->update(['name' => $request->name]);
        
        $syncData = [];
        foreach ($request->exercises as $exerciseId) {
            $syncData[$exerciseId] = [
                'sets_target' => 3, // default value
                'reps_target' => 10, // default value
            ];
        }
        $routine->exercises()->sync($syncData);

        return redirect()->route('routines.index')->with('success', 'Routine updated successfully!');
    }

    public function destroy(Routine $routine)
    {
        $routine->delete();
        return redirect()->route('routines.index')->with('success', 'Routine deleted successfully!');
    }
}

