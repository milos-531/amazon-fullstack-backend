@extends('master')
@section('content')
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <h1>Change your name</h1><br><br>
            <form action="changename" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">New Name</label>
                    <input type="text" value="name" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your new name" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection