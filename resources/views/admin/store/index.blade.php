@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Store Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('store.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Store')</a>
              @else
              <a href="{{ route('store.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Store')</a>
              @endif
                <a href="{{ route('store.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Store')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Store Name</th>
                  <th>Store Email</th>
                  <th>Store Number</th>
                  <th>Store Agreement</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($storeDetails as $store)
                <tr>
                  <td>{{$store->name}}</td>
                  <td>{{$store->email}}</td>
                  <td>{{$store->number}}</td>
                  <td><a href="{{$store->imgPath}}" target="_blank"><img src="{{$store->imgPath}}" width="150" height="100"></a><a href="" download="{{$store->imgPath}}">  <i class="fa fa-download" aria-hidden="true"></i></a></td>
                  <td>{{date('M d, Y h:i', strtotime($store['updated_at']))}}</td>
                  <td id="enable{{$store->id}}">
                  @if($store->id != 2)
                      @if($store->status)
                          <button type="button" id="enable{{$store->id}}" onclick="UpdateStatus({{$store->id}}, '0','storeStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$store->id}}" onclick="UpdateStatus({{$store->id}}, '1', 'storeStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  @else
                    <button type="button" id="disable{{$store->id}}"  class="btn btn-success" disabled=''>Active</button>
                   @endif
                  </td> 
                  @if($store->id != 2)
                    <td><a href="{{ route('store.edit',[$store->id]) }}" class="btn btn-warning">Edit</a></td>
                  @else
                    <td><button class="btn btn-warning" disabled=''>Edit</button></td>
                  @endif
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
 
    