<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Room;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');

        if(Auth::user()){
            $user_id = Auth::user()->id;
            $input['user_id'] = $user_id;

        }

        $comment = new Comment;
        $comment->fill($input);
        $comment->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function showRoom($id){
       if(strlen($id) == 15){
            $room = Room::where('key',$id)->first();
        }
        else{
            $room = Room::where('id',$id)->first();

        }

        $user_id = null;
        if(Auth::user()){
            $user_id = Auth::user()->id;

        }
      /*  if($room->status == 'Private' and $room->user_id !== $user_id){
            return redirect()->route('index')->with('message','Please enter your url');
        }*/
        $comments = $this->getComment($id);
        $data = [
            'id' => $id,
            'user_id' => $user_id,
            'comments' => $comments,
            'title' => 'Room-'.$id,
            'room' => $room,
        ];
        return view('room',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getComment($where = false){

        if($where){
            $comment = Comment::where('room_id',$where)->get();

        }
        else{
            $comment = Comment::all();

        }

        return $comment;
    }
}
