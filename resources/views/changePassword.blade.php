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
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                    </div>
                    @endif
                    <form action="{{route('changePassword')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="current_password"><strong>Current Password:</strong></label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password"><strong>New Password:</strong></label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password"><strong>Confirm New Password:</strong></label>
                            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
                        </div>
                        <button class="btn btn-primary" type="submit">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection