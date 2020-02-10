@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">user rate</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Id</th>

                            <th>Name</th>

                            <th width="400px">Star</th>

                        </tr>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $user->averageRating }}" data-size="xs" disabled="">
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#input-id").rating();
});
</script>

@endsection