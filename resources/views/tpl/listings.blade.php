@extends('layouts.master_frontend')

@section('content')
    <div class="row py-4">
        @if (count($images))
            @foreach ($images as $image)
                <div class="col-sm-6 py-3">
                    <img src="{{ asset(config('image.thumb_folder')) . '/' . $image->image }}" alt=""
                        class="img-responsive img-thumbnail">
                </div>
                <div class="col-sm-6">
                    <p class="title py-3">
                        <a href="{{ route('get_image_information', ['id' => $image->id]) }}" style="text-decoration: none">{{ $image->title }}</a>

                        <a href="{{ route('delete_image', ['id' => $image->id]) }}" style="text-decoration: none;color:rgb(252, 107, 107);font-size:12px;">Delete</a>


                    </p>
                </div>
            @endforeach
            {{-- In the AppServiceProvide.php file, in the boot method i registered the Paginator::useBootstrap(); so that it'll take care of the messy pagination that shows up --}}
            <p>{{ $images->links() }}</p>
        @else
            <div class="col-sm-12">
                <p class="no-img-found">No Images uploaded yet! Please consider uploading one. <a
                        href="{{ Route('index_page') }}">Upload here!</a></p>
            </div>
        @endif

    </div>
@endsection
