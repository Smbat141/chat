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
                    <a href="{{route('create')}}" ><button class="btn btn-primary">Create new room</button></a>
                </div>
                @endif
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms->reverse() as $room)
                                <tr>
                                    <td>
                                        <a href="{{ route('private',[$room->id]) }}" id="get_room">
                                            <img style="width: 100px;height: 100px;" src="{{asset('images')}}/{{$room->image}}">
                                        </a>
                                    </td>
                                    <td>
                                        {{$room->name}}
                                    </td>
                                    <td>
                                        <div  style="width: 6rem;">
                                            <span class="badge badge-primary" style="background-color:#1f648b"> {{$room->status}}</span>
                                        </div>
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