@include('errors')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">Web app</p>

                </div>
                @if(isset($user))
                    <div class="panel-heading">
                    <p><input name="search" type="checkbox" class="search_status" value="Public">  Public</p>
                    <p><input name="search" type="checkbox" class="search_status" value="Private"> Private</p>
                    </div>
                <div class="panel-heading">
                    <a href="{{route('room.create')}}" ><button class="btn btn-primary">Create new room</button></a>
                </div>
                @endif
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Room Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">User name</th>
                        </tr>
                        </thead>
                        <tbody>

                           @foreach($rooms->reverse() as $room)
                               <tr class="get_room">
                                   @if(isset($room->key))
                                       <input type="hidden" value="{{url('room-number/'.$room->key)}}" class="url">
                                       <input type="hidden" value="{{$room->user_id}}" class="rooom_user_id">
                                       <input type="hidden" value="{{$user->id}}" class="user_id">
                                   @endif
                                   <td>
                                       <a href="{{$room->status_id == 2 ? route('rooms',[$room->key]) : route('rooms',[$room->id])}}" >
                                           <img style="width: 100px;height: 100px;" src="{{asset('images')}}/{{$room->image}}" class="test">
                                       </a>
                                   </td>
                                   <td>
                                       {{$room->name}}
                                   </td>
                                   <td>
                                       <div  style="width: 6rem;" >
                                           <span class="badge badge-primary status" style="background-color:#1f648b"> {{$room->status->name}}</span>
                                       </div>
                                   </td>
                                   <td>
                                       {{$room->user->name}}
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
