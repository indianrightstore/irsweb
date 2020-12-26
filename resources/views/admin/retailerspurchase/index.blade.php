@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Retailers Purchase Details Table</h3>
			<div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('retailerspurchase.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Retailers Purchase')</a>
              @else
              <a href="{{ route('retailerspurchase.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Retailers Purchase')</a>
              @endif
              </p>
            </div>
				{!! Form::open(['method' => 'POST', 'route' => ['retailerspurchase.store']]) !!}       
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1"> Select Store*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="store_id" id="store_id">
                        <option value="">Select Store Name</option>
                        @foreach($store as $storeValue)
                        <option value="{{$storeValue->id}}">{{$storeValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-primary" id="submit-btn" style="float:right;">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Store Name</th>
                  <th>Order ID</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($retailersPurchaseDetails as $retailers)
                <tr>
                  <td>{{$retailers->store_name}}</td>
                  <td>{{$retailers->order_id}}</td>
                  <td>{{date('M d, Y h:i', strtotime($retailers['updated_at']))}}</td>
                  <td id="enable{{$retailers->id}}">
                      @if($retailers->status)
                          <button type="button" id="enable{{$retailers->id}}" onclick="UpdateStatus({{$retailers->id}}, '0','categoryStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$retailers->id}}" onclick="UpdateStatus({{$retailers->id}}, '1', 'categoryStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  </td> 
                    <td><a href="{{ route('retailerspurchase.edit',[$retailers->id]) }}" class="btn btn-warning">Order Product</a></td>
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
 
    