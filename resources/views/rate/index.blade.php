
@extends('layouts.app')



@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <form action="{{route('rateShow',$user->id)}}" method="POST">

                        @csrf

                    <div class="card">

                        <div class="container-fliud">

                            <div class="wrapper row">

                                <div class="preview col-md-6">

                                    <div class="preview-pic tab-content">

                                      <div class="tab-pane active" id="pic-1"><img src="{{$user->avatar}}" /></div>

                                    </div>

                                </div>

                                <div class="details col-md-6">

                                    <h3 class="product-title">{{$user->name}}</h3>

                                    <div class="rating">

                                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $user->userAverageRating }}" data-size="xs">

                                        <input type="hidden" name="id" required="" value="{{ $user->id }}">
                                        <br/>
                                        <button class="btn btn-success">Submit Review</button>

                                    </div>




                                </div>

                            </div>

                        </div>

                    </div>

                    </form>



                </div>

            </div>

        </div>

    </div>

</div>



<script type="application/javascript">

    $("#input-id").rating();

</script>

@endsection

