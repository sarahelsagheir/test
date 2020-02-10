@extends('layouts.app')
@section('content')
<div class="container">
    <section>
    @if( session()->has('success') )
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
       
                    @endif
             <div class="row">
            @foreach($products as $product)
            @if(empty($product->price)&&($product->status==0))
            <div class="col-md-4">
                <div class="card mb-2">
                    <img class="card-img-top" src="{{ $product->image }}">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="{{route('recievedBook',$product->id)}}" class="btn btn-primary">recieved</a>
                        <!-- <a href="{{route('didnotRecievedNotification',$product->id)}}" class="btn btn-primary">Not recieved</a> -->
<a href="{{route('rateNotification',$product->user_id)}}"  class="btn btn-primary">rate user</a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        

        </div>
</section>
</div>
@endsection