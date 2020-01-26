@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->get('message'))
    <div class="alert alert-success" role="alert">
        <strong>SUCESS &nbsp;</strong> {{session()->get('message')}}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}}'s Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form enctype="multipart/form-data" action="{{route('addBook')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="title"><strong>Title:</strong></label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="author"><strong>Author:</strong></label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="form-group">
                            <label for="category"><strong>Category:</strong></label>
                            <select class="browser-default custom-select" id="category" name="category">
                                <option disabled selected>Open this select menu</option>
                                <option value="Fiction">Fiction</option >
                                <option value="History">Histroy</option>
                                <option value="classics">classics</option>
                                <option value="non-Fiction">non-Fiction</option>
                                <option value="Historical-Fiction">Historical-Fiction</option>
                                <option value="Childern">CHildern</option>
                                <option value="Biography">Biography</option>
                                <option value="Horror">Horror</option>
                                <option value="Thriller">Thriller</option>
                                <option value="Romance">Romance</option>
                                <option value="Sci-Fiction">Sci-Fiction</option>
                                </select>

                        </div>
                        <div class="form-group">
                            <input type="file" name="cover_img" class="form-control">
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                        </div>
                        <button class="btn btn-primary" type="submit">Share Book </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection