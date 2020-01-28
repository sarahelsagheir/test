@extends('layouts.app')
 
@section('content')
<div class="card-deck">


@if($books->count())

@foreach($books as $book)
<div class="card">


    <img class="card-img-top" src="{{asset($book->cover_img)}}" alt="cover_img">
    <div class="card-body">
      <h5 class="card-title">{{ $book->title }}</h5>
      <p class="card-text">{{ $book->id}}</p>
      <p class="card-text">{{ $book->category }}</p>
      <p class="card-text"> {{$book->user->name}}</p>
      <form method="post" action="{{route('deleteBook',$book->id)}}">

@csrf

@method('delete')

<button class="btn btn-danger btn-lg"  onclick="return confirm('are you sure?')" type="submit">Delete</button>
      </form>

    </div>    </div>



                            @endforeach

                        @endif

                    </table>



                </div>

            </div>

        </div>

    </div>

</div>




@endsection