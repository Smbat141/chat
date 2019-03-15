@include('errors')
<div style="width: 215px;height: 570px;border:1px solid red;margin-left: 118px;position:absolute ">
<h4 class="text-center">Users</h4>
    <hr/>
    <p id="users_count" class="text-center">

    </p><hr/>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if($room->status == 'Private' and $room->user_id == $user_id)
                    <div class="panel-heading">
                       <p>Your room url <a href="{{url('room-number/'.$room->key)}}">{{url('room-number/'.$room->key)}}</a></p>
                    </div>
                        <form method="POST" action="{{route('room.store')}}">
                            {{csrf_field()}}
                            <div>
                                <label for="email" class="col-md-4 control-label">Send url in email address</label>
                                <input type="hidden" name="room_url" value="{{url('room-number/'.$room->key)}}">
                                <input type="email" placeholder="email adress" name="email_to">
                                <input type="submit" value="send">
                            </div>
                        </form>
                @endif
                <div class="panel-heading">
                       <button class="btn btn-primary" style="margin-left: 664px"> <a href="{{route('index')}}" style="color: white">Exit</a></button>
                </div>
                <div class="panel-heading"  style="width: 100%;height: 300px;overflow: auto">
                    @foreach($comments as $comment)
                        <div class="alert alert-primary text-center">
                            @if(isset($comment->user->name))
                                <p>{{$comment->user->name}}</p>
                                @else
                                <p>Guest</p>
                            @endif
                            <p>{{$comment->text}}</p>
                        </div>
                        <hr/>
                    @endforeach
                </div>
                <div class="panel-heading">
                    <form action="{{route('comment.store')}}"  class="contact-form" id="comment" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="hidden"  name="room_id" value="{{$id}}">
                            <input type="hidden"  name="user_id" value="{{$user_id}}">
                            <input type="text"  name="text" class="form-control" placeholder="Room">
                            <button type="submit" class="btn-primary" id="submit">Save</button>
                        </div>
                    </form>
                </div>
                    @if($room->user_id == $user_id)
                        <form action="{{route('room.destroy',$room->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="hidden" value="{{$room->status}}" name="test">
                            <button class="btn btn-primary" type="submit" style="margin-left: 630px">Delete room</button>
                        </form>
                    @endif
                </div>
        </div>
    </div>
</div>