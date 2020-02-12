@extends('layouts.app')
@section('content')


<div class="col-md-6 offset-md-2">

    @if( session('status'))

        <div class="alert alert-info">

            {{ session('status')}}

        </div>

    @endif
</div>

    <section>
    @if( session()->has('success') )
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
       
                    @endif
                    @include('searchForm')

             <div class="row">
            @foreach($products as $product)
            @if(!empty($product->price))
            <div class="col-md-4">
                <div class="card mb-2">
                    <img class="card-img-top" src="{{ $product->image }}">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                       <p> ${{$product->price}}</p>
                        <a href="{{route('cart.add',$product->id)}}" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        

        </div>
</section>
</div>
@endsection