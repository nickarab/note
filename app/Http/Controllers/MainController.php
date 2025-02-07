<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function index(){

    $id = session('user.id');
    $notes = User::find($id)->notes()->get()->toArray();

    return view('home', ['notes' => $notes]);

  }

  public function editNote($id){

    $id = Operations::DecryptID($id);
    $note = Note::find($id);
    return view('edit_note', ['note' => $note]);
  }

   public function deleteNote($id){

    $id = Operations::DecryptID($id);

   }

  public function newNotes(){

    return view('new_note');

  }

  public function newSubmitNotes(Request $request ){

    $request->validate(
        [
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:2000'
        ],
        [
            'text_title.required' => 'o título é um campo obrigatório',
            'text_note.required' => 'a nota é um campo obrigatório',
            'text_title.min' => 'o título precisa ter no minimo :min caracteres',
            'text_title.max' => 'o título pode ter no máximo :max caracteres',
            'text_note.max' => 'a nota pode ter no máximo :max caracteres',
            'text_note.min' => 'a nota precisa ter no minimo :min caracteres'
        ]
    );

    $id = session('user.id');
    $note = new Note();
    $note->user_id = $id;
    $note->title = $request->text_title;
    $note->text = $request->text_note;
    $note->save();

    return redirect('/');
  }

  public function editSubmitNote(Request $request){

    $request->validate(
        [
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:2000'
        ],
        [
            'text_title.required' => 'o título é um campo obrigatório',
            'text_note.required' => 'a nota é um campo obrigatório',
            'text_title.min' => 'o título precisa ter no minimo :min caracteres',
            'text_title.max' => 'o título pode ter no máximo :max caracteres',
            'text_note.max' => 'a nota pode ter no máximo :max caracteres',
            'text_note.min' => 'a nota precisa ter no minimo :min caracteres'
        ]
    );
    if(!$request->note_id == null){
        redirect()->to('home');
    }

    $id = Operations::DecryptID($request->note_id);
    $note = Note::find($id);
    $note->title = $request->text_title;
    $note->text = $request->text_note;
    $note->save();
    return redirect()->route('home');
  }

}
