@extends('admin.master')

@section('title','Home')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="">
                @foreach ($posts as $item)               
                    <div class="card mt-2 mb-4">
                        <div class=" mt-2 ms-3 d-flex">
                            @if (Auth::user()->image == null)
                            @if (Auth::user()->gender == 'male')
                                  <img src="{{ asset('img/default-male.png') }}" class="img-profile rounded-circle"  style="width: 50px;heigth:20px;"/>
                            @elseif (Auth::user()->gender == 'female')
                                 <img src="{{ asset('img/default-female.jpg') }}" class="img-profile rounded-circle"  style="width: 50px;heigth:20px;"/>
                            @endif
                         @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-profile rounded-circle"  style="width: 50px;heigth:20px;"/>
                        @endif
                     
                      <div class=" ms-3 ">
                        <span class="font-mono text-dark mb-2">{{ Auth::user()->name }}</span> </br>
                        <span>{{ $item->created_at }}</span>
                      </div>
                        </div>
                         
                       
                        <div class="card-body mt-3 mb-2">
                            <div class=" mb-2">
                                <span>{{ $item->name }}</span>
                            </div>
                            <div class=" mb-2">
                                <span>{{ $item->description }}</span>
                            </div>
                            <div class="">
                                @if ( $item->image == null)
                                <span>No Uplode photo</span>
                             @else
                                 <img src="{{ asset('storage/'.$item->image) }}" class="img-thumbnail-sm"  width="100%" height="auto" />
                             @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            </div>
        </div>
    </div>
@endsection