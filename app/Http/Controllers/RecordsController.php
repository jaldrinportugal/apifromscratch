<?php

namespace App\Http\Controllers;

use App\Models\Records;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class RecordsController extends Controller
{
    public function records(){
        $record = Records::all();
        return response($record);
    }

    public function record($id){
        $record = Records::find($id);
        return response($record);
    }

    public function post(Request $request)
    {
        $record=new Records();
        $record->title = $request->title;
        $record->author = $request->author;
        $record->published_at = $request->published_at;

        $record->save();
        return response([
            "message"=>"Records added in database!!"
        ]);
    }

    public function update(Request $request)
    {
        $record = Records::findorfail($request->id);

        $record->title = $request->title;
        $record->author = $request->author;
        $record->published_at = $request->published_at;

        $record->update();
        return response([
            "message"=>"Updated Succesfully"
        ]);
    }

    public function delete($id){
        $user = Records::find($id);
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