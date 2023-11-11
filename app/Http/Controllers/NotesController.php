<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetStoredNote;
use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
use App\Http\Requests\DeleteNotesRequest;

use App\Models\Notes;
use App\Http\Resources\NotesResource;
use Laravel\Prompts\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(NotesResource::collection(Notes::all()), Notes::all());
        return NotesResource::collection(auth()->user()->notes()->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $note = new Notes();
        // $note->note_title = $request->note_title;
        // $note->note_body = $request->note_body;
        // $note->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotesRequest $request, Notes $notes)
    {
        $note = new Notes();
        $notes->note_title = $request->note_title;
        $notes->note_body = $request->note_body;
        $notes->user_id = auth()->user()->id;
        $notes->save();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $notes, $id)
    {
        $note = $notes::where('id',$id)->firstOrFail();
        $this->authorize('view', $note);
        return NotesResource::make($note);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotesRequest $request, Notes $notes, $id)
    {
        $note = Notes::find($id);
        $note->note_title = $request->note_title;
        $note->note_body = $request->note_body;
        $note->save();
        return NotesResource::make($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteNotesRequest $request, Notes $notes,$id)
    {
        $note = Notes::find($id);
        $note->delete();
        return response()->noContent();
    }
}
