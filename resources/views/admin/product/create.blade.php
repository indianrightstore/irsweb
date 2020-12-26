@extends('layouts.master')
@section('content')
@if ($errors->count() > 0)
    <p class="help-block" style="color: red;">
            @foreach($errors->all() as $error)
            <div class="alert alert-danger col-md-6">
                {{ $error }}  
            </div>
            @endforeach
        </p>
@endif
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12" style="padding: 12px;">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">@if(!empty($productDetails)) Edit @else Add New @endif Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($productDetails))
              
               {!! Form::model($productDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['product.update', $productDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['product.store']]) !!}       
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
				  <div class="row">
				  <div class="form-group col-md-6">
                   <label for="exampleInputPassword1"> Select Manufacturer Store*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="manufacturer_id" id="manufacturer_id">
                        <option value="">Select Manufacturer Name</option>
                        @foreach($manufacturer as $manufacturerValue)
                        <option value="{{$manufacturerValue->id}}" @if(isset($productDetails['id'])) {{ $manufacturerValue['id'] == $productDetails['manufacturer_id'] ? 'selected' : '' }} @endif>{{$manufacturerValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
				  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Discount on Product(%)*</label>
                    <input type="number" class="form-control required_field" step="any" name="discount" id="discount" data-table="product" data-edit ="@if(!empty($productDetails['id'])) {{$productDetails->id}} @endif" value="@if(!empty($productDetails['id'])){{$productDetails['discount']}}@endif" placeholder="Enter Discount on Product">
                  </div>
                  </div>
				<div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Product Name*</label>
                    <span class="text-danger" id="name_error"></span>
                    <input type="text" class="form-control required_field unique_entry alphaonly" name="name" id="name" data-table="product" data-edit ="@if(!empty($productDetails['id'])) {{$productDetails->id}} @endif" value="@if(!empty($productDetails['name'])) {{$productDetails['name']}} @endif" placeholder="Enter Product Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Product Price*</label>
                    <input type="number" class="form-control required_field" step="any" name="price" id="price" data-table="product" data-edit ="@if(!empty($productDetails['id'])) {{$productDetails->id}} @endif" value="@if(!empty($productDetails['id'])){{$productDetails['price']}}@endif" placeholder="Enter Product Price">
                  </div>
				  </div>
				  <div class="row">
				  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Product Market Price*</label>
                    <input type="number" class="form-control required_field" step="any" name="market_price" id="market_price" data-table="product" data-edit ="@if(!empty($productDetails['id'])) {{$productDetails->id}} @endif" value="@if(!empty($productDetails['id'])){{$productDetails['market_price']}}@endif" placeholder="Enter Market Product Price">
                  </div>
                  <div class="form-group col-md-6">
                   <label for="exampleInputPassword1"> Select Brand Name*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="brand_id" id="brand_id">
                        <option value="">Select Brand Name</option>
                        @foreach($brand as $brandValue)
                        <option value="{{$brandValue->id}}" @if(isset($productDetails['id'])) {{ $brandValue['id'] == $productDetails['brand_id'] ? 'selected' : '' }} @endif>{{$brandValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary" id="submit-btn" style="float:right;">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
            
            <!-- /.card -->
          </div><!--/.col (right) -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
@endsection
@push('js')
@include('admin.userJs')
@endpush
