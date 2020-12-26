@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Roles Table</h3>
            </div>
            <div class="card-header">
              <p>
                <a href="{{ route('role.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Role')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Last Modified</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roleDetails as $roles)
                <tr>
                  <td>{{$roles->name}}</td>
                  <td>{{date('M d, Y h:i', strtotime($roles['updated_at']))}}</td>
                  <td><a href="{{ route('role.edit',[$roles->id]) }}" class="btn btn-warning">Edit</button></a></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
    </section>
   
@endsection
@push('js')
@include('admin.userJs')
@endpush
 
    