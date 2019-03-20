<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$url = url(Room::->key);
        $user = Auth::user();
        if($user){
            $rooms = Room::all();
        }
        else{
            $rooms = Room::where('status','Public')->get();
        }
        $data = [
            'rooms' => $rooms,
            'title' => 'Home',
            'user' => $user,
        ];
        return view('welcome',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
    if(Auth::user()){
        $data = [
            'title' => 'Create new room',
        ];

        return view('new_room',$data);
    }
    else{
        abort(404);
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {

       // dd($request->all());
        $data = $request->except('_token');
        $user = Auth::user()->id;
        $data['user_id'] = $user;
        if($data['status'] == 'Private'){
            $data['key'] = str_random(15);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $data['image'] = $file->hashName();
            $file->move(public_path('images'),$data['image']);

        }
        $room = new Room();
        $room->fill($data);

        if($room->save()){
            if($data['status'] == 'Private'){
                return redirect()->route('rooms',$room->key);
            }
            return redirect()->route('rooms',$room->id);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
