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
                <h3 class="card-title">@if(!empty($currencyDetails)) Edit @else Add New @endif Currency</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($currencyDetails))
              
               {!! Form::model($currencyDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['currency.update', $currencyDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['currency.store']]) !!}
              
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Currency Code*</label>
                    <input type="text" class="form-control required_field unique_entry alphaonly" step="any" name="currency_code" id="currency_code" style="text-transform:uppercase" data-table="currency_code" data-edit ="@if(!empty($currencyDetails['id'])) {{$currencyDetails->id}} @endif" value="@if(!empty($currencyDetails['currency_code'])) {{$currencyDetails['currency_code']}} @endif" placeholder="Enter currency Code">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Conversion Rate*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <input type="number" class="form-control required_field" name="conversion_rate" step="any" id="conversion_rate" min="0" max="999999999999999" value="@if(!empty($currencyDetails['conversion_rate'])){{$currencyDetails['conversion_rate']}}@endif" placeholder="Enter Conversion Rate">
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
