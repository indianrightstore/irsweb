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
                <h3 class="card-title">@if(!empty($subcategoryDetails)) Edit @else Add New @endif Sub Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($subcategoryDetails))
              
               {!! Form::model($subcategoryDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['subcategory.update', $subcategoryDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['subcategory.store']]) !!}       
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
				  <div class="form-group col-md-12">
                   <label for="exampleInputPassword1"> Select Category*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="category_id" id="category_id">
                        <option value="">Select Category Name</option>
                        @foreach($category as $categoryValue)
                        <option value="{{$categoryValue->id}}" @if(isset($subcategoryDetails['id'])) {{ $categoryValue['id'] == $subcategoryDetails['category_id'] ? 'selected' : '' }} @endif>{{$categoryValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
				  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Sub Category Name*</label>
                    <span class="text-danger" id="name_error"></span>
                    <input type="text" class="form-control required_field unique_entry alphaonly" step="any" name="name" id="name" data-table="subcategory" data-edit ="@if(!empty($subcategoryDetails['id'])) {{$subcategoryDetails->id}} @endif" value="@if(!empty($subcategoryDetails['name'])) {{$subcategoryDetails['name']}} @endif" placeholder="Enter Sub Category Name">
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
