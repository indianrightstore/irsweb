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
                <h3 class="card-title">@if(!empty($countryDetails)) Edit @else Add New @endif Country</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($countryDetails))
              
               {!! Form::model($countryDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['country.update', $countryDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['country.store']]) !!}
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
               <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name*</label>
                    <input type="text" class="form-control required_field unique_entry alphaonly" name="name" id="name" data-table="country_name" data-edit ="@if(!empty($countryDetails['id'])) {{$countryDetails->id}} @endif" value="@if(!empty($countryDetails['name'])) {{$countryDetails['name']}} @endif" placeholder="Enter Country Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Country Code*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <input type="text" class="form-control required_field unique_entry alphaonly" name="country_code" data-table="country_code" id="country_code" data-edit ="@if(!empty($countryDetails['id'])) {{$countryDetails->id}} @endif" value="@if(!empty($countryDetails['country_code'])) {{$countryDetails['country_code']}} @endif" placeholder="Enter Country Code">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Latitude*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <input type="number" class="form-control required_field" name="latitude" id="latitude" step="any" max="999999999999" value="@if(!empty($countryDetails['latitude'])){{$countryDetails['latitude']}}@endif" placeholder="Enter Latitude">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">longitude*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <input type="number" class="form-control required_field" name="longitude" id="longitude" step="any" max="999999999999" value="@if(!empty($countryDetails['longitude'])){{$countryDetails['longitude']}}@endif" placeholder="Enter Longitude">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Currency Code*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="currency_code_id" id="currency_code_id">
                        <option value="">Currency Code</option>
                        @foreach($currencyDetails as $currencyValue)
                        <option value="{{$currencyValue->id}}" @if(isset($countryDetails['currency_code_id'])) {{ $currencyValue['id'] == $countryDetails['currency_code_id'] ? 'selected' : '' }} @endif>{{$currencyValue->currency_code}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Status*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="status" id="status">
                        <option value="">Status</option>
                        <option value="1" @if(isset($countryDetails['status'])) {{ $countryDetails['status'] == '1' ? 'selected' : '' }} @endif >@lang('Enable')</option>
                        <option value="0" @if(isset($countryDetails['status'])) {{ $countryDetails['status'] == '0' ? 'selected' : '' }} @endif >@lang('Disable')</option>
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
