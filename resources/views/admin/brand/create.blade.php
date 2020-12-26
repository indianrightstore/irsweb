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
                <h3 class="card-title">@if(!empty($brandDetails)) Edit @else Add New @endif Brand</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($brandDetails))
              
               {!! Form::model($brandDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['brand.update', $brandDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['brand.store']]) !!}       
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Brand Name*</label>
                    <span class="text-danger" id="name_error"></span>
                    <input type="text" class="form-control required_field unique_entry alphaonly" step="any" name="name" id="name" data-table="brand" data-edit ="@if(!empty($brandDetails['id'])) {{$brandDetails->id}} @endif" value="@if(!empty($brandDetails['name'])) {{$brandDetails['name']}} @endif" placeholder="Enter Brand Name">
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
