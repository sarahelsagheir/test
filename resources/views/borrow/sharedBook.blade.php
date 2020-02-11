
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
                        <a href="{{'/sharedBook/recieved/'.$product->id}}" class="btn btn-primary">recieved</a>
                        <!-- <a href="#" class="btn btn-primary" class="dropdown">Not recieved</a> -->
                        <div class="btn-group dropright">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Not recieved
  </button>
  <div class="dropdown-menu">

                        <form action="{{'/conversation/send/1'}}" method="post">
@csrf
<textarea  @keydown.enter="send" placeholder="Message..." name="text" id="text"></textarea>
<button type="submit">send</button>
</form>
</div>
</div>

                    </div>
                </div>
            </div>
            @endif
        @endforeach
        </div>
</section>
</div>
@endsection

