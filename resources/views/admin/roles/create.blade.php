@extends('admin.app')

@section('title', 'Dahsboard')

@section('content')
<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center  mb-4">
    <h1 class="h3 text-gray-800 mb-0">Add New Role</h1>
    <a class="btn btn-primary" href="{{ route('admin.roles.index') }}">All Roles</a>
</div>

@include('admin.errors')

<form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <label>Name</label>
    <input type="text" placeholder="Name" class="form-control" name="name" />
</div>

<label><input type="checkbox" id="check_all" /> All </label><br>
@foreach ($permissions as $p)
    <label> <input type="checkbox" value="{{ $p->id }}" name="permissions[]"> {{ $p->name }}</label> <br>
@endforeach

<button class="btn btn-success"> <i class="fas fa-save"></i> Save</button>
<button type="button" onclick="history.back()" class="btn btn-secondary"> <i class="fas fa-ban"></i> Cancel</button>
</form>

@stop

@section('scripts')

<script>
    $('#check_all').change(function() {
        $('input[type=checkbox]').attr('checked', this.checked )
    })
</script>

@stop
