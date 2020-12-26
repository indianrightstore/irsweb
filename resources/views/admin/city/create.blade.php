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
          <div class="col-md-6" style="padding: 12px;">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">@if(!empty($cityDetails)) Edit @else Add New @endif City</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($cityDetails))
              
               {!! Form::model($cityDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['city.update', $cityDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['city.store']]) !!}
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
               <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
				<div class="row">
				<div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Select Country*</label>
                    <select for="status" class="form-control select  required_field required_field_select get_state" name="city_country_id" id="city_country_id">
                        <option value="">Select Country</option>
                        @foreach($countryDetails as $countryValue)
                        <option value="{{$countryValue->id}}" @if(isset($cityDetails['id'])) {{ $cityDetails['city_country_id'] == $countryValue['id'] ? 'selected' : '' }} @endif>{{$countryValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
				  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Select State</label>
                    <select for="status" class="form-control select  required_field required_field_select change" name="state_id" id="state_id">
                        <option value="">Select State</option>
                        <!--@foreach($stateDetails as $stateValue)
                        <option value="{{$stateValue->id}}" @if(isset($cityDetails['id'])) {{ $cityDetails['state_id'] == $stateValue['id'] ? 'selected' : '' }} @endif>{{$stateValue->name}}</option>
                        @endforeach-->
                    </select>
                  </div>
				</div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Name*</label>
                    <input type="text" class="form-control required_field unique_entry alphaonly" name="name" id="name" data-table="city_name" data-edit ="@if(!empty($cityDetails->id)) {{$cityDetails->id}} @endif" value="@if(!empty($cityDetails['name'])) {{$cityDetails['name']}} @endif" placeholder="Enter City Name">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Latitude*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <input type="number" class="form-control required_field" name="latitude" id="latitude" step="any" max="999999999999" value="@if(!empty($cityDetails['latitude'])){{$cityDetails['latitude']}}@endif" placeholder="Enter Latitude">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">longitude*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <input type="number" class="form-control required_field" name="longitude" id="longitude" step="any" max="999999999999" value="@if(!empty($cityDetails['longitude'])){{$cityDetails['longitude']}}@endif" placeholder="Enter Longitude">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Pincode*</label>
                    <span class="text-danger"></span>
                    <input type="number" class="form-control required_field" name="pincode" id="pincode" max="999999999999" value="@if(!empty($cityDetails['pincode'])){{$cityDetails['pincode']}}@endif" placeholder="Enter Pincode">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Status*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="status" id="status">
                        <option value="">Status</option>
                        <option value="1" @if(isset($cityDetails['status'])) {{ $cityDetails['status'] == '1' ? 'selected' : '' }} @endif >@lang('Enable')</option>
                        <option value="0" @if(isset($cityDetails['status'])) {{ $cityDetails['status'] == '0' ? 'selected' : '' }} @endif >@lang('Disable')</option>
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

@include('partials.admin.stateCityFunction')
@endsection
@push('js')
@include('admin.userJs')
@endpush
