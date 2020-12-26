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
                <h3 class="card-title">@if(!empty($roleDetails)) Edit @else Add New @endif Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($roleDetails))
              
               {!! Form::model($roleDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['role.update', $roleDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['role.store']]) !!}
              
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" id="submit">Submit</button>
               <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Role Title*</label>
                    <input type="text" class="form-control required_field unique_entry" name="name" id="name" data-table="role" data-edit ="@if(!empty($roleDetails['id'])) {{$roleDetails->id}} @endif" value="@if(!empty($roleDetails['name'])) {{$roleDetails['name']}} @endif" placeholder="Enter Role Title">
                  </div>
                      <div class="form-group">
                       <label>Select Permission*</label>
                       <div class="select2-purple">
                        <select class="select2 required_field required_field_select" multiple="multiple" data-placeholder="Select a Permission" name="mainPer[]" id="mainPer" style="width: 100%;">
                        @foreach($permissionDetails as $permissionKey=> $permissionDetail)
                          <option value="{{$permissionDetail->id}}" @if(isset($data)) @if(in_array($permissionDetail->id,$data)) selected="selected" @endif @endif>{{$permissionDetail->name}}</option>
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