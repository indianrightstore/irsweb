@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Currency Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('currency.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Currency')</a>
              @else
              <a href="{{ route('currency.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Currency')</a>
              @endif
                <a href="{{ route('currency.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Currency')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Currency Code</th>
                  <th>Converstion Rate</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($currencyDetails as $currency)
                <tr>
                  <td>{{$currency->currency_code}}</td>
                  <td>{{$currency->conversion_rate}}</td>
                  <td>{{date('M d, Y h:i', strtotime($currency['updated_at']))}}</td>
                  <td id="enable{{$currency->id}}">
                  @if($currency->id != 2)
                      @if($currency->status)
                          <button type="button" id="enable{{$currency->id}}" onclick="UpdateStatus({{$currency->id}}, '0','currencyStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$currency->id}}" onclick="UpdateStatus({{$currency->id}}, '1', 'currencyStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  @else
                    <button type="button" id="disable{{$currency->id}}"  class="btn btn-success" disabled=''>Active</button>
                   @endif
                  </td> 
                  @if($currency->id != 2)
                    <td><a href="{{ route('currency.edit',[$currency->id]) }}" class="btn btn-warning">Edit</a></td>
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
 
    