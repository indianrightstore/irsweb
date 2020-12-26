@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Country Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('country.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Country')</a>
              @else
              <a href="{{ route('country.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Country')</a>
              @endif
                <a href="{{ route('country.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Country')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Country Code</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Currency Code</th>
                  <th>Conversion Rate</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countryDetails as $country)
                <tr>
                  <td>{{$country->name}}</td>
                  <td>{{$country->country_code}}</td>
                  <td>{{$country->latitude}}</td>
                  <td>{{$country->longitude}}</td>
                  <td>{{$country->currency_code}}</td>
                  <td>{{$country->conversion_rate}}</td>
                  <td>{{date('M d, Y h:i', strtotime($country['updated_at']))}}</td>
                  <td id="enable{{$country->id}}">
                      @if($country->status)
                          <button type="button" id="enable" onclick="UpdateStatus({{$country->id}}, '0','countryStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable" onclick="UpdateStatus({{$country->id}}, '1', 'countryStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  </td> 
                  <td>
                  <a href="{{ route('country.edit',[$country->id]) }}" class="btn btn-info">Edit</a>
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
 
    