@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">State Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('state.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active State')</a>
              @else
              <a href="{{ route('state.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive State')</a>
              @endif
                <a href="{{ route('state.create') }}" class="btn btn-success" style="float: left;">@lang('Add New State')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>State Name</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stateDetails as $state)
                <tr>
                  <td>{{$state->name}}</td>
                  <td>{{date('M d, Y h:i', strtotime($state['updated_at']))}}</td>
                  <td id="enable{{$state->id}}">
                      @if($state->status)
                          <button type="button" id="enable{{$state->id}}" onclick="UpdateStatus({{$state->id}}, '0','stateStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$state->id}}" onclick="UpdateStatus({{$state->id}}, '1', 'stateStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  </td> 
                    <td><a href="{{ route('state.edit',[$state->id]) }}" class="btn btn-warning">Edit</a></td>
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
 
    