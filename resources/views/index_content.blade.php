@include('errors')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">Web app</p>
                </div>
                <div class="panel-heading">
                    <a href="{{route('create')}}" ><button class="btn btn-primary">Create new room</button></a>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                            @foreach($rooms->reverse() as $room)
                                <li class="list-group-item">
                                    <a href="{{route('room.show',$room->id)}}">
                                        <img style="width: 100px;height: 100px;" src="{{asset('images')}}/{{$room->image}}">
                                        {{$room->name}}
                                    </a>
                                </li>
                            @endforeach
                    </ul>



                </div>
            </div>
        </div>
    </div>
</div>