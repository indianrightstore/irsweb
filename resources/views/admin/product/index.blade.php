@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('product.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Product')</a>
              @else
              <a href="{{ route('product.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Product')</a>
              @endif
                <a href="{{ route('product.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Product')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Manufacturer Name</th>
                  <th>Prices</th>
                  <th>Market Prices</th>
                  <th>Profit</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productDetails as $product)
                <tr>
                  <td>{{$product->name}}</td>
                  <td>{{$product->manufacturers_name}}</td>
                  <td>Rs. {{$product->price}}</td>
                  <td>Rs. {{$product->market_price}}</td>
                  <td>Rs. {{ $product->market_price - $product->price}}</td>
                  <td>{{date('M d, Y h:i', strtotime($product['updated_at']))}}</td>
                  <td id="enable{{$product->id}}">
                      @if($product->status)
                          <button type="button" id="enable{{$product->id}}" onclick="UpdateStatus({{$product->id}}, '0','productStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$product->id}}" onclick="UpdateStatus({{$product->id}}, '1', 'productStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  </td> 
				  <td><a href="{{ route('product.edit',[$product->id]) }}" class="btn btn-warning">Edit</a></td>
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
 
    