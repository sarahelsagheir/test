@extends('layouts.app')
@section('content')


<div class="col-md-6 offset-md-2">



    <section>
                   @include('searchForm')

             <div class="row">
            @foreach($products as $product)
            @if(empty($product->price)&&($product->status==1)&&($product->user_id != auth()->user()->id))
            <div class="col-md-4">
                <div class="card mb-2">
                    <img class="card-img-top" src="{{ $product->image }}">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="card-text"><strong>Owner :</strong> {{$product->user->name}}</p>
                  <div><strong>Owner Rate:</strong>  <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $product->user->averageRating }}" data-size="xs" disabled="">
                  </div>
                  
                  <a href="{{'/borrow/'.$product->id.'/'.$product->user_id}}" class="btn btn-primary">Borrow</a>

                    </div>
                </div>
            </div>
            @elseif(!empty($product->price))


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