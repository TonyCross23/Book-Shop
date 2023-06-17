@extends('admin.master')

@section('title','Post Edit')

@section('content')
        <div class="container col-8 offset-2">

            @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i>  {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

            <div class="card">
                <a href="#" class="mt-2 ms-2" onclick="history.back()"><i class="fa-solid fa-arrow-left text-dark"></i></a>
                <div class="card-header text-center">
                    <h4>Edit Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin@postUpdate',$post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Post Name</label>
                            <input type="text" name="postName" class="form-control @error('postName') is-invalid @enderror" value="{{ old('postName',$post->name) }}" placeholder="Enter Post Name">
                            @error('postName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Category Type</label>
                            <select name="postCategoryName" class="form-control @error('postCategoryName') is-invalid @enderror">
                                <option value="">Chose Options</option>
                        
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" @if ( $post->category_id == $item->id)
                                        selected
                                    @endif>{{ $item->title }}</option>
                                @endforeach

                                @error('postCategoryName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            </select>
                    
                        </div>

                        <div class="form-group">
                            <label for="">Post Image</label>
                            <input type="file" name="postImage" class="form-control @error('postImage') is-invalid @enderror" value="{{ old('postImage') }}" placeholder="Chose Post Image">
                            @error('postImage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Post Description</label>
                             <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Post Description">{{ old('postDescription',$post->description) }}</textarea>
                             @error('postDescription')
                             <small class="text-danger">{{ $message }}</small>
                         @enderror
                            </div>
                        <input type="submit" class="btn btn-primary float-right" value="Update Post">
                    </form>
                </div>
            </div>
        </div>
@endsection