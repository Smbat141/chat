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



    public function index(){

   $user = Auth::user();
    if($user){
        $rooms = Room::all();
    }
    else{
        $rooms = Room::where('status_id',1)->get();
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


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        if($user){
            if($request->ajax()){
                $select_data = json_decode($request->get('status'));
                if(empty($select_data)){
                    $rooms = Room::all();
                }
                else{
                    $rooms = Room::whereIn('status_id',$select_data)->get();
                }
                $html = '';
                $link = '';
                foreach ($rooms->reverse() as $room){
                    $link=$room->status->name == "Private" ? route("rooms",$room->key) : route("rooms",[$room->id]);
                    $private_data = '';
                    if(isset($room->key)){
                        $private_data = '
                                    <input type="hidden" value="'.url('room-number/'.$room->key).'" class="url">
                                    <input type="hidden" value="'.$room->user_id.'" class="rooom_user_id">
                                    <input type="hidden" value="'.$user->id.'" class="user_id">
                                    ';
                    }
                    $html .= '<tr class="get_room">'.$private_data
                        .
                        '<td>'.
                        '<a href="'.$link.'">'.
                        '<img class="test" style="width: 100px;height: 100px;" src="'.asset("images").'/'.$room->image.'">'
                        .'</a>'.
                        '</td>'.
                        '<td>'.$room->name.'</td>'.
                        '<td>'.'<div style="width: 6rem;"><span class="badge badge-primary status" style="background-color:#1f648b"> '.$room->status->name.'</span>'.'</div></td>'.
                        '<td>'.$room->user->name.'</td>'
                        .'<tr>';

                }

                return Response($html);

            }

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
