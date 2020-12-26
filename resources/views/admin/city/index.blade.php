@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">City Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('city.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active City')</a>
              @else
              <a href="{{ route('city.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive City')</a>
              @endif
                <a href="{{ route('city.create') }}" class="btn btn-success" style="float: left;">@lang('Add New City')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Pincode</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cityDetails as $city)
                <tr>
                  <td>{{$city->name}}</td>
                  <td>{{$city->latitude}}</td>
                  <td>{{$city->longitude}}</td>
                  <td>{{$city->pincode}}</td>
                  <td>{{date('M d, Y h:i', strtotime($city['updated_at']))}}</td>
                  <td id="enable{{$city->id}}">
                      @if($city->status)
                          <button type="button" id="enable" onclick="UpdateStatus({{$city->id}}, '0','cityStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable" onclick="UpdateStatus({{$city->id}}, '1', 'cityStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  </td> 
                  <td>
                  <a href="{{ route('city.edit',[$city->id]) }}" class="btn btn-info">Edit</a>
                  </td>
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
 
    