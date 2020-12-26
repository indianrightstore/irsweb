@extends('layouts.master')
@section('content')
<section class="content">
      <div class="container-fluid">
      @if(session('success'))
<!-- If password successfully show message -->
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @else
        <div class="row">
          <!-- left column -->
          <div class="col-md-4" style="padding: 12px;">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chnage Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
                <div class="card-body">
                  <div class="form-group">
                  {!! Form::label('current_password', 'Current password*', ['class' => 'control-label']) !!}
                        {!! Form::password('current_password', ['class' => 'form-control required_field', 'placeholder' => '']) !!}
                       
                  </div>
                  <div class="form-group">
                  {!! Form::label('new_password', 'New password*', ['class' => 'control-label']) !!}
                        {!! Form::password('new_password', ['class' => 'form-control required_field', 'placeholder' => '', 'minlength' => 5, 'maxlength' => 15]) !!}
                        <p class="help-block" style="color: red;"></p>
                       
                  </div>
                  <div class="form-group">
                  {!! Form::label('new_password_confirmation', 'New password confirmation*', ['class' => 'control-label']) !!}
                        {!! Form::password('new_password_confirmation', ['class' => 'form-control required_field', 'placeholder' => '', 'minlength' => 5, 'maxlength' => 15]) !!}
                        <p class="help-block" style="color: red;"></p>
                        @if ($errors->count() > 0)
                            <p class="help-block" style="color: red;">
                                    @foreach($errors->all() as $error)
                                        {{ $error }}  
                                    @endforeach
                                </p>
                        @endif
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
      </div>
      @endif
      <!-- /.container-fluid -->
    </section>
@endsection
@push('js')
@include('admin.userJs')
@endpush
