@extends('admin.master')

@section('title','Change Profile')

@section('content')
        <div class="container col-8 offset-2">
        
            <div class="card">
                <div class=" ms-3 mt-4">
                    <a href="{{ route('admin@profile') }}"><i class="fa-solid fa-arrow-left text-dark"></i></a>
                </div>
                <div class="card-header">
                    <h5 class="d-flex justify-content-center">Admin Profile</h5>
                </div>
                <div class="card-body ">
                    <form action="{{ route('admin@change',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
               
                        <div class="row mb-3">
                            <div class="col-8 offset-2 mb-3">
                                <span class="mb-2">image</span>
                              <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ Auth::user()->image }}" >
                                @error('image')
                                          <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-8 offset-2 mb-3">
                                <span class="mb-2">Name</span>
                              <input type="text" name="adminName" class="form-control @error('adminName') is-invalid @enderror" value="{{ Auth::user()->name }}" >
                            </div>
                            <div class="col-8 offset-2 mb-3">
                                <span class="mb-2">Email</span>
                              <input type="text" name="adminEmail" class="form-control @error('adminEmail') is-invalid @enderror" value="{{ Auth::user()->email }}" >
                           
                            </div>
                            <div class="col-8 offset-2 mb-3">
                                <span class="mb-2">Phone</span>
                              <input type="text" name="adminPhone" class="form-control @error('adminPhone') is-invalid @enderror" value="{{ Auth::user()->phone }}" >
                       
                            </div>
                            <div class="col-8 offset-2 mb-3">
                                <span class="mb-2">Address</span>
                              <input type="text" name="adminAddress" class="form-control @error('adminAddress') is-invalid @enderror" value="{{ Auth::user()->address }}" >
                            
                            </div>
                            <div class="col-8 offset-2 mb-3">
                                <span class="mb-2">gender</span>
                                <select name="adminGender" class="form-control @error('adminGender') is-invalid @enderror">
                                    <option value="">Chose Gender</option>
                                    <option value="male" @if ( Auth::user()->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if ( Auth::user()->gender == 'female') selected @endif>Female</option>
                                </select>
                      
                            </div>
                        </div>
                      <a href="">
                        <input type="submit" class="btn btn-primary float-end me-5" value="Change">
                      </a>
                    </div>
                </div>
                    </form>
                </div>
@endsection