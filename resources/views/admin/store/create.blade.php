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
                <h3 class="card-title">@if(!empty($storeDetails)) Edit @else Add New @endif Store</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($storeDetails))
              
               {!! Form::model($storeDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['store.update', $storeDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['store.store']]) !!}       
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
				<div class="row">
                  <div class="form-group col-md-12">
                   <label for="exampleInputPassword1"> Select Store Category*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="store_category_id" id="store_category_id">
                        <option value="">Select Store Category</option>
						@if(!empty($storeCategory))
						@foreach($storeCategory as $storeCategoryValue)
                        <option value="{{$storeCategoryValue->id}}" @if(isset($storeDetails['id'])) {{ $storeCategoryValue['id'] == $storeDetails['store_category_id'] ? 'selected' : '' }} @endif>{{$storeCategoryValue->name}}</option>
						</select>
                        @endforeach
						@endif
                  </div>
                  </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Store Name*</label>
                    <input type="text" class="form-control required_field" name="name" id="name" data-table="store" data-edit ="@if(!empty($storeDetails['id'])) {{$storeDetails->id}} @endif" value="@if(!empty($storeDetails['name'])) {{$storeDetails['name']}} @endif" placeholder="Enter Store Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Store Email*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <input type="text" class="form-control required_field" name="email" id="email" data-table="store" data-edit ="@if(!empty($storeDetails['id'])) {{$storeDetails->id}} @endif" value="@if(!empty($storeDetails['id'])){{$storeDetails['email']}}@endif" placeholder="Enter store Email">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Store Contact Number*</label>
                    <input type="text" pattern="\d*" maxlength="10" class="form-control required_field" name="number" id="number" data-table="store" data-edit ="@if(!empty($storeDetails['id'])) {{$storeDetails->id}} @endif" value="@if(!empty($storeDetails['id'])){{$storeDetails['number']}}@endif" placeholder="Enter Store Contect Number">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Store Location*</label>
                    <input type="text" class="form-control required_field" name="store_location" id="location" data-table="store" data-edit ="@if(!empty($storeDetails['id'])) {{$storeDetails->id}} @endif" value="@if(!empty($storeDetails['id'])){{$storeDetails['store_location']}}@endif" placeholder="Enter Store Location">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                  <label>Select Productes*</label>
                  <div class="select2-purple">
                  <select class="select2 required_field required_field_select" multiple="multiple" data-placeholder="Select a Product" name="product[]" id="product" style="width: 100%;">
                  @foreach($productDetails as $productKey=> $productDetail)
                    <option value="{{$productDetail->id}}" @if(isset($data)) @if(in_array($productDetail->id,$data)) selected="selected" @endif @endif>{{$productDetail->name}}</option>
                  @endforeach
                </select>
                </div>
                </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Store Agrement*</label>
                    <input type="hidden" name="uploadPath" id="uploadPath" @if($upload['path']) value="{{$upload['path']}}@endif">
                    <input type="file" name="UploadBlogImage" id="UploadBlogImage" data-url="{{url('/upload-file')}}"  class="form-control fileUpload" accept="image/*" />
                    <label id="UploadBlogImage-error" class="error form-text text-danger" style="font-size: 80%;" for="video_file"></label>
                    <div id="progressUploadBlogImageFile" class="progress" style="display: none; background-color:#fff"  >
                    <div class="progress-bar progress-bar-green progress" style="width: 0%;height: 44%; " id="UploadBlogImageProgress" ></div>
                    </div>
                    <div class="UploadBlogImageFileName" id="UploadBlogImageFileName"></div>
                    <div id="UploadBlogImageFormFieldDiv"></div>
                    <div class="UploadBlogmageCanceluploadBtn" id="UploadBlogImageCanceluploadBtn"></div>
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
 
@include('partials.uploadJs')
@endsection
@push('js')
<script src="{{ asset('resources/assets/backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    $('.select2').select2()
  })
  </script>
@include('admin.userJs')
@endpush

@push('css')
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
