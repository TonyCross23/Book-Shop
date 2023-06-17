@extends('admin.master')

@section('title','Post List')

@section('content')
<div class="container">
  
    <div class="row">
        <div class="col-3">
            <h4 class="text-primary">Search Key : <span class="text-success">{{ request('key') }}</span> </h4>
        </div>
        <div class="col-3 offset-6">
       
            <form action="" method="get">
                @csrf
                <div class="d-flex">
                    <input type="text" name="key" class="form-control mr-2" placeholder="Search" value="{{ request('key') }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>

            
       @if (session('success'))
            <div class="col-12 mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i>  {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <span class="h5 mb-4 mt-3 mr-2">Post Lists</span>
            <a href="{{ route('admin@postIndex') }}" class="badge bg-success mb-3" title="Create Category"><i class="fa fa-plus"></i></a>
            {{-- <a href="{{ route('admin@pdfExport') }}" class="badge bg-danger mb-3" title="Create Category"><i class="fa-solid fa-file-pdf"></i></a> --}}
            <div class="table-wrap">
             
                <table class="table">
                  <thead class="thead-primary text-center">
                    <tr>
                      <th >ID</th>
                      <th >Image</th>
                      <th>Name</th>
                      <th >Category</th>
                      <th >Date</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                
                  <tbody>
                  @if (count($post) != 0)
                  @foreach ($post as $item)
                  <tr class="alert text-center" role="alert">
                    <td>{{ $item->id }}</td>
                    <td class="">
                      <img src="{{ asset('storage/'.$item->image) }}" class="mg-thumbnail shadow-sm" style="width: 75px; height:60px">
                    </td>
                    <td>{{ $item-> name}}</td>
                    <td>{{ $item->category_name }}</td>
                    <td>{{ $item->created_at->format('j-F-Y ') }}</td>
                    <td>
                         
                         <div class="d-flex justify-content-center">
                          <a href="{{ route('admin@postDetails',$item->id) }}" class="btn btn-success text-white btn-sm me-1"><i class="fa-solid fa-circle-info"></i></a>
                          <a href="{{ route('admin@postEditPage',$item->id) }}" class="btn btn-primary text-white btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                          <a href="{{ route('admin@postDelete',$item->id) }}" class="btn btn-danger text-white btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                         </div>
                        
                    </td>
                </tr>
                  @endforeach
                  @else
                  <td></td>
                  <td></td>
                  <td class="text-center"><span class="bg-danger text-white fs-3 rounded px-3 text-center">Empty Posts!</span></td>
                  <td></td>
                  @endif
               
                
                  </tbody>
              
                </table>
                <div class="mt-3">
                    {{ $post->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection