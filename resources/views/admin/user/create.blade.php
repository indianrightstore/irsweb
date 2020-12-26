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
                <h3 class="card-title">@if(!empty($userDetails)) Edit @else Add New @endif User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(!empty($userDetails))
              
               {!! Form::model($userDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['user.update', $userDetails->id]]) !!}
               @else
                {!! Form::open(['method' => 'POST', 'route' => ['user.store']]) !!}
              
               @endif
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" id="submit">Submit</button>
               <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">User Name*</label>
                    <input type="text" class="form-control required_field" name="name" id="name" autocomplete="off" value="@if(!empty($userDetails['name'])) {{$userDetails['name']}} @endif" placeholder="Enter User Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Email Address*</label>
                    <span class="text-danger" id="email_errors"></span>
                    <span class="text-danger" id="email_error"></span>
                    <input type="email" autocomplete="off" class="form-control required_field" name="email" id="email" value="@if(!empty($userDetails['email'])) {{$userDetails['email']}} @endif" placeholder="Enter User Email">
                    <input type="hidden" name="userId" id="userId" value="@if(!empty($userDetails['id'])) {{$userDetails['id']}}@endif">
                  </div>
                  </div>
                  @if(empty($userDetails))
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Password @if(empty($userDetails)) * @endif</label>
                    <input type="password" autocomplete="off" class="form-control @if(empty($userDetails)) required_field @endif" name="password" id="password" placeholder="Enter Password">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Confirm Password @if(empty($userDetails)) * @endif</label>
                    <span class="text-danger" id="password_error"></span>
                    <input type="password" autocomplete="off" class="form-control @if(empty($userDetails)) required_field @endif" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
                  </div>
                  </div>
                  @endif
                  <div class="row">
                  <div class="form-group col-md-6">
                       <label>Select Roles*</label>
                       <div class="select2-purple">
                        <select class="select2 required_field required_field_select" multiple="multiple" data-placeholder="Select Roles" name="roles[]" id="roles" style="width: 100%;">
                        @foreach($roleDetails as $roleDetail)
                          <option value="{{$roleDetail->id}}" @if(isset($data)) @if(in_array($roleDetail->id,$data)) selected="selected" @endif @endif>{{$roleDetail->name}}</option>
                        @endforeach
                      </select>
                      </div>
                </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Status*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="status" id="status">
                        <option value="">Status</option>
                        <option value="1" @if(isset($userDetails['status'])) {{ $userDetails['status'] == '1' ? 'selected' : '' }} @endif >@lang('Enable')</option>
                        <option value="0" @if(isset($userDetails['status'])) {{ $userDetails['status'] == '0' ? 'selected' : '' }} @endif >@lang('Disable')</option>
                    </select>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary user_submit" id="submit-btn" style="float:right;">Submit</button>
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

// for confirm password
$(document).on('keyup', '#confirm_password', function(){
var password = $('#password').val();
var confirmPassword = $('#confirm_password').val();
  if(password == confirmPassword){
    $("#password_error").html('');
    $('.user_submit').removeAttr('disabled', 'disabled');
  }else{
    $("#password_error").html("Password Do Not Match.");
    $('.user_submit').attr('disabled', 'disabled');
  }
});

</script>
@include('admin.userJs')
@endpush
@push('css')
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush