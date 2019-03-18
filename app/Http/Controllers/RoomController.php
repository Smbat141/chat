<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Room;
use http\Url;
use Cache;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        //dd($input);

        Mail::send('email',['input' => $input],function ($message) use ($input){

            $mail_name = env('MAIL_USERNAME');

            $message->to($input['email_to'])->subject('Chat');

            $message->from($mail_name);
        });

        if(Mail::failures()){
            return redirect()->back()->with('message','Email not send');
        }
        return redirect()->back()->with('message','Email  send');
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
            $id = $room->id;
        }
        else{
            $room = Room::where('id',$id)->first();

        }

        $user_id = null;

        if(Auth::user()){
            $user_id = Auth::user()->id;
        }
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
        $user_id = Auth::user()->id;
        if(strlen($id) == 15){
            $room = Room::where('key',$id)->first();
        }
        else{
            $room = Room::where('id',$id)->first();

        }
        if($room->user_id == $user_id){
            $comments = $room->comments;

            foreach ($comments as $comment){
                $comment->delete();
            }

            $room->delete();

            return redirect()->route('index')->with('message','Room deleted');
        }
        return redirect()->route('index')->with('message','Not rules');


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
