<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\RoomRequest;
use App\Room;
use Carbon\Carbon;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{



    public function roomShow(Request $request){

        $user = Auth::user();
        if($user){
            if($request->ajax()){
                $rooms = Room::where('status',$request->get('status'))->get();
                $html = '';
                $a = '';
                foreach ($rooms as $room){
                    $a=$room->status == "Private" ? route("rooms",$room->key) : route("rooms",[$room->id]);
                    $html .= '<tr class="get_room">'.
                                    '
                                    <input type="hidden" value="'.url('room-number/'.$room->key).'" class="url">
                                    <input type="hidden" value="'.$room->user_id.'" class="rooom_user_id">
                                    <input type="hidden" value="'.$user->id.'" class="user_id">
                                    '.
                                '<td>'.
                                    '<a href="'.$a.'">'.
                                        '<img class="test" style="width: 100px;height: 100px;" src="'.asset("images").'/'.$room->image.'">'
                                    .'</a>'.
                                '</td>'.
                                '<td>'.$room->name.'</td>'.
                                '<td>'.'<div style="width: 6rem;"><span class="badge badge-primary status" style="background-color:#1f648b"> '.$room->status.'</span>'.'</div></td>'.
                                '<td>'.$room->user->name.'</td>'
                            .'<tr>';

                }

                return Response($html);

            }
            else{
                $rooms = Room::all();

            }
        }
        else{
            $rooms = Room::where('status',$request->get('status'))->get();
        }
        $data = [
            'rooms' => $rooms,
            'title' => 'Home',
            'user' => $user,
        ];
        return view('welcome',$data);
    }





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
