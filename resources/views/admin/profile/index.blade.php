@extends('admin.master')

@section('title', 'Profile')

@section('content')
    <div class="container col-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h5 class="d-flex justify-content-center">Admin Profile</h5>
            </div>
            <div class="card-body text-cneter">

                <div class="mt-3 d-flex align-item-center" style="width:160px; height:150px; margin-left:260px;">
                    @if (Auth::user()->image == null)
                        @if (Auth::user()->image == null)
                            <img src="https://ui-avatars.com/api/?background=random&color=random&name={{ Auth::user()->name }}"
                                class="img-profile rounded-circle me-1" />
                        @endif
                    @else
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail" />
                    @endif

                </div>
                <div class="row mb-3">
                    <div class="col-8 offset-2 mb-3">
                        <span class="mb-2">Name</span>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="col-8 offset-2 mb-3">
                        <span class="mb-2">Email</span>
                        <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                    </div>
                    <div class="col-8 offset-2 mb-3">
                        <span class="mb-2">Phone</span>
                        <input type="text" class="form-control" value="{{ Auth::user()->phone }}" disabled>
                    </div>
                    <div class="col-8 offset-2 mb-3">
                        <span class="mb-2">Address</span>
                        <input type="text" class="form-control" value="{{ Auth::user()->address }}" disabled>
                    </div>
                    <div class="col-8 offset-2 mb-3">
                        <span class="mb-2">gender</span>
                        <input type="text" class="form-control" value="{{ Auth::user()->gender }}" disabled>
                    </div>
                </div>
                <a href="{{ route('admin@changeProfile') }}">
                    <input type="button" class="btn btn-primary float-right" value="Change Profile">
                </a>
            </div>
        </div>
    </div>
@endsection

@section('script')
