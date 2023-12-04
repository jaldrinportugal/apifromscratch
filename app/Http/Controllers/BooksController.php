<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BooksController extends Controller
{
    public function Books(){
        $book = Books::all();
        return response($book);
    }

    public function Book($id){
        $book = Books::find($id);
        return response($book);
    }

    public function post(Request $request)
    {
        $book=new Books();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_at = $request->published_at;

        $book->save();
        return response([
            "message"=>"Books added in database!!"
        ]);
    }

    public function update(Request $request)
    {
        $book = Books::findorfail($request->id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_at = $request->published_at;

        $book->update();
        return response([
            "message"=>"Updated Succesfully"
        ]);
    }

    public function delete($id){
        $user = Books::find($id);
        if ($user == null){
            return response([
                "message"=>"Record not found"
            ],404);
        }
        else{
            $user->delete();
            return response([
                "message"=>"Deleted succesfully!"
            ],200);
        }
    }
}