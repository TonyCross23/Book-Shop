@extends('admin.master')

@section('title', 'Post Detail')

@section('content')
    <div class="container col-8 offset-2">
        <div class="card">
            <div class="card-header">
                <a href="#" class="mt-2 ms-2" onclick="history.back()"><i
                        class="fa-solid fa-arrow-left text-dark"></i></a>
                <h5 class="d-flex justify-content-center">Post Details</h5>
            </div>
            <div class="card-body text-cneter mb-2">
                {{-- <a href="{{ route('admin@deletePhoto',Auth::user()->id) }}" class="float-right" title="delete photo"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a> --}}
                <div class="mt-3 d-flex align-item-center" style="width:160px; height:150px; margin-left:260px;">
                    @if ($post->image == null)
                        <span>No Uplode photo</span>
                    @else
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail" />
                    @endif

                </div>

                <div class="mt-4 text-center">
                    <span>{{ $post->id }}</span> <br />
                    <span>{{ $post->name }}</span> <br />
                    <span>{{ $postdata->category_name }}</span> <br />
                    <br /> <span>{{ $post->description }}</span>
                </div>

            </div>
        </div>
    </div>
@endsection
