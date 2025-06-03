<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function createNote(Request $req)
    {
        if ($req->noteTitle && $req->noteDesc && $req->image) {
            $newname = time() . $req->image->getClientOriginalName();
            $move = $req->image->move(public_path('image'), $newname);
            if ($move) {
                $note = new Note;
                $note->title = $req->noteTitle;
                $note->description = $req->noteDesc;
                $note->user_id = $req->userId;
                $note->note_image = $newname;
                $save = $note->save();
                if ($save) {
                    return redirect('/dashboard')->with('notemessage', 'Note created successfully');
                } else {
                    return 'not saved';
                }
            } else {
                return 'not moved';
            }
        } elseif ($req->noteTitle && $req->noteDesc) {
            $note = new Note;
            $note->title = $req->noteTitle;
            $note->description = $req->noteDesc;
            $note->user_id = $req->userId;
            $save = $note->save();
            if ($save) {
                return redirect('/dashboard')->with('notemessage', 'Note created successfully');
            } else {
                return 'not saved';
            }
        } else {
            return 'Not working';
        }
    }

    public function editNote(Request $req, $noteId)
    {
        $note = Note::where('id', $noteId)->first();
        if ($note) {
            $note->title = $req->input('editNoteTitle');
            $note->description = $req->input('editNoteDesc');
            $note->save();
            return redirect('/dashboard')->with('notemessage', 'Note updated successfully');
        } else {
            return redirect('/dashboard')->with('notemessage', 'Note not found');
        }
    }

    public function deleteNote($noteId)
    {
        $delete = Note::where('id', $noteId)->first()->delete();
        if ($delete) {
            return redirect('/dashboard')->with('notemessage', 'Note deleted successfully');
        }
    }
}
