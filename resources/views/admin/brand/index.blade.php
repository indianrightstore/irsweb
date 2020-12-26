@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Brand Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('brand.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Brand')</a>
              @else
              <a href="{{ route('brand.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Brand')</a>
              @endif
                <a href="{{ route('brand.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Brand')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Brand Name</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brandDetails as $brand)
                <tr>
                  <td>{{$brand->name}}</td>
                  <td>{{date('M d, Y h:i', strtotime($brand['updated_at']))}}</td>
                  <td id="enable{{$brand->id}}">
                      @if($brand->status)
                          <button type="button" id="enable{{$brand->id}}" onclick="UpdateStatus({{$brand->id}}, '0','brandStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$brand->id}}" onclick="UpdateStatus({{$brand->id}}, '1', 'brandStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  </td> 
                    <td><a href="{{ route('brand.edit',[$brand->id]) }}" class="btn btn-warning">Edit</a></td>
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
 
    