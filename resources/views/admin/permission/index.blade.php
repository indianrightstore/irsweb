@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Permission Table</h3>
            </div>
            <div class="card-header">
              <p>
                <a href="javascript:void(0);" class="btn btn-success openBtn" data-id="0" style="float: left;">@lang('Add New permission')</a>
              </p> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Permission Name</th>
                  <th>Description</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissionDetails as $permission)
                <tr>
                  <td>{{$permission->name}}</td>
                  <td>{{$permission->description}}</td>
                  <td><a href="javascript:void(0);" class="btn btn-warning openBtn" data-id ="{{$permission->id}}">Edit</button></a></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
    <div class="modal fade" id="myPermisionModal"></div>
    </section>
   
@endsection
@push('js')
<script>
$('.openBtn').on('click',function(){
  var id = $(this).attr("data-id");
  if(id == '0'){
    url = "{{url('add-permission')}}";
  }else{
    url = "{{url('edit-permission')}}";
  }
    $.ajax({
        dataType: "json",
        type: "post",
        url: url,
        data:  { "_token": "{{ csrf_token() }}", id : id}
    }).done(function(data){
        if(data.code==200){
          $('#myPermisionModal').html(data.view);
          $('#myPermisionModal').modal({show:true});
        }else{
            alert("failed");
        }
    });    
});
</script>
@include('admin.userJs')
@endpush
 
    