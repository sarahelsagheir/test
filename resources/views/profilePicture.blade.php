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
        @include('includes.profile_sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}}'s Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form enctype="multipart/form-data" action="{{route('profileAvatar')}}" method="post">
                        <div class="form-group">
                            <input type="file" name="avatar" class="form-control">
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                        </div>
                        <button class="btn btn-primary" type="submit">Upload Picture </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection