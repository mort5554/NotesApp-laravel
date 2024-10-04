<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    /*public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:20|min:3',
            'content' => 'required|string|max:255|min:5'
        ]);
        //dd($valideData);
        $validateData['user_id'] = $request->user()->id;
        //$validateData['user_id'] = 1;
        $note = Note::create($validateData);

        return to_route('note.index', $note)->with('message', 'Udało się utworzyć notatkę');
    }*/

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('note.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    /*public function update(Request $request, Note $note)
    {
        $validateData = $request->validate([

        ]);
        //dd($valideData);
        $validateData['user_id'] = $request->user()->id;
        //$validateData['user_id'] = 1;
        //dd(now());

        $note->update($validateData);

        return to_route('note.index')->with('message', 'Udało się edytować notatkę');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if($note->user_id !== request()->user()->id){
            abort(403);
        }
        $note->delete();
        return to_route('note.index')->with('message', 'Udało się usunąć notatkę');
    }
}
