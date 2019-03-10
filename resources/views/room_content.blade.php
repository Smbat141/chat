<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
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
                </div>
                    @foreach($comments as $comment)
                        <p>{{$comment->text}}</p>
                    @endforeach
                </div>
        </div>
    </div>
</div>