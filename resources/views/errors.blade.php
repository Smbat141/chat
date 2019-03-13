
@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(session('message'))
    <div class="alert alert-success" role="alert">
        <p> {{session('message')}}</p>
    </div>
@endif

