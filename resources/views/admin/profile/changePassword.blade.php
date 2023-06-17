@extends('admin.master')

@section('title','Change Password')

@section('content')
        <div class="container col-8 offset-2 ">
            @if (session('notMatch'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>  {{ session('notMatch') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check me-2"></i>  {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin@changePassword') }}" method="post">
                            @csrf
                            <div class="">
                                    <label for="">Old Password</label>
                                    <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Enter Old Password">
                                    @error('oldPassword')
                                         <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            <div class="">
                                <label for="">New Password</label>
                                <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter New Password">
                                @error('newPassword')
                                       <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        <div class="my-4 float-right">
                           <input type="submit" class="btn btn-primary text-white" value="Change Password">
                        </div>
                        </form>
                    </div>
                </div>
        </div>
@endsection