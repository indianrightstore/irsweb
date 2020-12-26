@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manufacturer Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('manufacturer.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Manufacturer')</a>
              @else
              <a href="{{ route('manufacturer.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Manufacturer')</a>
              @endif
                <a href="{{ route('manufacturer.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Manufacturer')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Manufacturer Name</th>
                  <th>Manufacturer Email</th>
                  <th>Manufacturer Number</th>
                  <th>Manufacturer Agreement</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($manufacturerDetails as $manufacturer)
                <tr>
                  <td>{{$manufacturer->name}}</td>
                  <td>{{$manufacturer->email}}</td>
                  <td>{{$manufacturer->contact}}</td>
				  <td><a href="{{$manufacturer->imgPath}}" target="_blank"><img src="{{$manufacturer->imgPath}}" width="150" height="100"></a><a href="" download="{{$manufacturer->imgPath}}">  <i class="fa fa-download" aria-hidden="true"></i></a></td>
                  <td>{{date('M d, Y h:i', strtotime($manufacturer['updated_at']))}}</td>
                  <td id="enable{{$manufacturer->id}}">
                 
                      @if($manufacturer->status)
                          <button type="button" id="enable{{$manufacturer->id}}" onclick="UpdateStatus({{$manufacturer->id}}, '0','manufacturerStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$manufacturer->id}}" onclick="UpdateStatus({{$manufacturer->id}}, '1', 'manufacturerStatus')" class="btn btn-danger">Inactive</button>
                      @endif
  
                  </td> 
                    <td><a href="{{ route('manufacturer.edit',[$manufacturer->id]) }}" class="btn btn-warning">Edit</a></td>
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
 
    