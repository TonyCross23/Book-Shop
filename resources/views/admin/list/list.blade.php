@extends('../admin/master')

@section('title','Admin List')

@section('content')
    <div class="container">
         <div class="card" >
            <div class="card-header">
                <span>Admin List</span>
            </div>
            <div class="card-body">
                <table class="table datatable"  style="width: 100%;">
                    <thead class=" thead-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </td>
                    </thead>
                </table>
            </div>
         </div>
    </div>

    @section('table')

    $(document).ready(function () {
    var table_dt =  $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/datatable/ssd',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            { data: 'gender', name: 'gender' },
            { data: 'action', name: 'action' },
         ]
    });
    $(document).on('click','.delete',function(){
        var id = $(this).data('id');
            $.ajax({
                url : `/user/${id}/delete`,
                type : 'GET',
                success :  function(){
                    table_dt.ajax.reload();
                }
            })
     });


        
});


@endsection


@endsection
