@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="detail-img" src="{{$product['image']}}" alt="">
        </div>
        <div class="col-sm-6">
            <a href="/">Go back</a>
            <h2>{{$product['name']}}</h2>
            <h3>Price: ${{$product['price']}}</h3>
            <h3>Rating: {{$product['rating']}} stars</h3>
            <h3>Category: {{$product['category']}} stars</h3>
            <h3>Details: {{$product['description']}} stars</h3>
            <br><br>
            <button class="btn btn-primary">Add to cart</button>
            <br><br>
            <button class="btn btn-success">Buy now</button>
            <br><br>
        </div>
    </div>
</div>
@endsection