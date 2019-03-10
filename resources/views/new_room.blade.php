@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="text-center">Creat new room</p>
                    </div>
                    <div class="panel-heading">
                        <form action="{{route('store')}}"  class="contact-form" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Room name</label>
                                <input type="text"  name="name" class="form-control" placeholder="Room">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control" name="status">
                                    <option>Public</option>
                                    <option>Private</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="form-control-file" value="Create">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection