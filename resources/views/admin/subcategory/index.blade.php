@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sub Category Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('subcategory.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Category')</a>
              @else
              <a href="{{ route('subcategory.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Category')</a>
              @endif
                <a href="{{ route('subcategory.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Sub Category')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sub Category Name</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subcategoryDetails as $subcategory)
                <tr>
                  <td>{{$subcategory->name}}</td>
                  <td>{{date('M d, Y h:i', strtotime($subcategory['updated_at']))}}</td>
                  <td id="enable{{$subcategory->id}}">
                  @if($subcategory->id != 2)
                      @if($subcategory->status)
                          <button type="button" id="enable{{$subcategory->id}}" onclick="UpdateStatus({{$subcategory->id}}, '0','subcategoryStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$subcategory->id}}" onclick="UpdateStatus({{$subcategory->id}}, '1', 'subcategoryStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  @else
                    <button type="button" id="disable{{$subcategory->id}}"  class="btn btn-success" disabled=''>Active</button>
                   @endif
                  </td>               
                    <td><a href="{{ route('subcategory.edit',[$subcategory->id]) }}" class="btn btn-warning">Edit</a></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
    </section>
   
@endsection
@push('js')
@include('admin.userJs')
@endpush
 
    