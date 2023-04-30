@extends('admin.app')

@section('title', 'Dahsboard')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Settings</h1>
<form action="{{ route('admin.settings_data') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row align-items-center mb-3">
        <label class="col-md-1 mb-0"><b>Logo</b></label>
        <div class="col-md-6">
            <input type="file" class="form-control" name="logo" />
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <label class="col-md-1 mb-0"><b>Facebook</b></label>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{ settings('fb') }}" name="fb" />
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <label class="col-md-1 mb-0"><b>Twitter</b></label>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{ settings('tw') }}" name="tw" />
        </div>
    </div>

    <button class="btn btn-success"> <i class="fas fa-save"></i> Save</button>
    <button type="button" onclick="history.back()" class="btn btn-secondary"> <i class="fas fa-ban"></i> Cancel</button>
</form>
@stop


