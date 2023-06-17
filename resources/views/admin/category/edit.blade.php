@extends('admin.master')

@section('title','Category Edit')

@section('content')
        <div class="container col-8 offset-2">

            @if (session('Success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i>  {{ session('Success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

            <div class="card">
                <div class="card-header">
                    <h4>Create Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin@categoryEdit',$category->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="categoryTitle" class="form-control @error('categoryTitle') is-invalid @enderror" value="{{ old('categoryTitle',$category->title) }}" placeholder="Enter Catgory Title">
                            @error('categoryTitle')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Category Description</label>
                             <textarea name="categoryDescription" class="form-control @error('categoryDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Category Description">{{ old('categoryDescription',$category->description) }}</textarea>
                        </div>
                        <input type="submit" class="btn btn-primary float-right" value="Update Category">
                    </form>
                </div>
            </div>
        </div>
@endsection