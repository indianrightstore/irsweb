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
          <div class="col-md-4" style="padding: 12px;">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">@if(!empty($stateDetails)) Edit @else Add New @endif State</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($stateDetails))
              
               {!! Form::model($stateDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['state.update', $stateDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['state.store']]) !!}
              
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">State Name*</label>
                    <input type="text" class="form-control required_field unique_entry alphaonly" step="any" name="name" id="name" data-table="state_name" data-edit ="@if(!empty($stateDetails['id'])) {{$stateDetails->id}} @endif" value="@if(!empty($stateDetails['name'])) {{$stateDetails['name']}} @endif" placeholder="Enter State Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1"> Select Country*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="country_id" id="country_id">
                        <option value="">Select Country Name</option>
                        @foreach($country as $countryValue)
                        <option value="{{$countryValue->id}}" @if(isset($country['id'])) {{ $currencyValue['country_id'] == $country['id'] ? 'selected' : '' }} @endif>{{$countryValue->name}}</option>
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
            
            <!-- /.card -->
          </div><!--/.col (right) -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
@endsection
@push('js')
@include('admin.userJs')
@endpush
