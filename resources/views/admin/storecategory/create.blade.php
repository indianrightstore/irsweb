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
                <h3 class="card-title">@if(!empty($categoryDetails)) Edit @else Add New @endif Store Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($categoryDetails))
              
               {!! Form::model($categoryDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['storecategory.update', $categoryDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['storecategory.store']]) !!}       
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Store Category Name*</label>
                    <span class="text-danger" id="name_error"></span>
                    <input type="text" class="form-control required_field unique_entry alphaonly" step="any" name="name" id="name" data-table="category" data-edit ="@if(!empty($categoryDetails['id'])) {{$categoryDetails->id}} @endif" value="@if(!empty($categoryDetails['name'])) {{$categoryDetails['name']}} @endif" placeholder="Enter Store Category Name">
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
