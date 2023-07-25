@extends('layouts.master_frontend')

@section('content')
    <form action="/" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Image name</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter image title here...">
        </div>
        <br>
        <div class="form-group">
            <label for="image">Upload image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group mt-2">
            <button type="submit" class="btn bg-gradient btn-primary">Save</button>
        </div>
    </form>
@endsection
