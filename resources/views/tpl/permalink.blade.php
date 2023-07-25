@extends('layouts.master_frontend')

@section('content')
    <div class="row">
        <div class="col-sm-5">
            <p>{{ $image->title }}</p>
            <img src={{ asset('uploads/thumbs' .'/'. $image->image) }} alt="broken image" class="img-responsive" width="100%">
        </div>

        <div class="col-sm-7">
            <p>Direct Image Url</p>
            <input onclick="this.select()" type="text" value="{{ asset('uploads/') .'/'. $image->image }}" class="form-control">
            <p>Thumbnail forum BBCode</p>
                <input type="text" onclick="this.select()" value="[url={{URL::to('snatch/'.$image->id)}}]" class="form-control">
                {{-- <p>Thumbnail HTML Code</p>
                <input type="text" onclick="this.select()" value="{{HTML::entities(HTML::link(URL::to('snatch/'.$image->id), HTML::image(config('image.thumb_folder').'/'.$image->image)))}}"  class="form-control">--}}
            </div> 

        </div>
    @endsection
