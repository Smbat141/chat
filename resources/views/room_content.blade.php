<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users Count<span id="users_count"></span>
                        <button class="btn btn-primary" style="margin-left: 580px">Exit</button>
                </div>
                <div class="panel-heading">
                    <form action="{{route('room.store')}}"  class="contact-form" id="comment" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="hidden"  name="room_id" value="{{$id}}">
                            <input type="hidden"  name="user_id" value="{{$user_id}}">
                            <input type="text"  name="text" class="form-control" placeholder="Room">
                            <button type="submit" class="btn-primary" id="submit">Save</button>
                        </div>
                    </form>
                </div>
                <div class="panel-heading">
                    @foreach($comments as $comment)
                        <div class="alert alert-primary">
                            <p>{{$comment->user->name}}</p>
                            <p>{{$comment->text}}</p>
                        </div>
                        <hr/>
                    @endforeach
                </div>

                </div>
        </div>
    </div>
</div>