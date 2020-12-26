@extends('layouts.master')  
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category Table</h3>
            </div>
            <div class="card-header">
              <p>
              @if($btnStatus == '1')
                <a href="{{ route('category.index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Category')</a>
              @else
              <a href="{{ route('category.index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Category')</a>
              @endif
                <a href="{{ route('category.create') }}" class="btn btn-success" style="float: left;">@lang('Add New Category')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Category Name</th>
                  <th>Last Modified</th>
                  <th class="toggle-button">Status</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categoryDetails as $category)
                <tr>
                  <td>{{$category->name}}</td>
                  <td>{{date('M d, Y h:i', strtotime($category['updated_at']))}}</td>
                  <td id="enable{{$category->id}}">
                  @if($category->id != 2)
                      @if($category->status)
                          <button type="button" id="enable{{$category->id}}" onclick="UpdateStatus({{$category->id}}, '0','categoryStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable{{$category->id}}" onclick="UpdateStatus({{$category->id}}, '1', 'categoryStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  @else
                    <button type="button" id="disable{{$category->id}}"  class="btn btn-success" disabled=''>Active</button>
                   @endif
                  </td>               
                    <td><a href="{{ route('category.edit',[$category->id]) }}" class="btn btn-warning">Edit</a></td>
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
 
    