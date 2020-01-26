<div class="col-md-3">
<div class="card">
    <div class="card-header">Sidebar</div>
    <img src="/image/{{ Auth::user()->avatar}}" alt="profile_picture" style="width:250px; height:250px;" >
</div>
<div class="card">
    <div class="card-header">Sidebar</div>
    <a class="btn btn-primary btn-block" href="{{route('home')}}" >Dashboard</a>
    <a class="btn btn-primary btn-block" href="{{route('changePassword')}}" >Change password</a>
    <a class="btn btn-primary btn-block" href="{{route('profileAvatar')}}" >Upload Profile Picture</a>
    <a class="btn btn-primary btn-block" href="{{route('addBook')}}" >Share Book</a>
    <a class="btn btn-primary btn-block" href="{{route('books')}}" > My Book </a>

</div>
</div>
