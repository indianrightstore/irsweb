<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">@if(!empty($permissionDetails)) Edit @else Create New @endif Permission</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @if(!empty($permissionDetails))
        {!! Form::model($permissionDetails, ['method' => 'PUT', 'class'=>'target', 'route' => ['permission.update', $permissionDetails->id]]) !!}
      @else
        {!! Form::open(['method' => 'POST', 'route' => ['permission.store']]) !!}
      @endif
      {{ csrf_field() }}
      <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
      <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
      <div class="modal-body">
      <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Permission Name*</label>
                    <input type="text" class="form-control required_field unique_entry" name="name" id="name" data-table="permission" data-edit ="@if(!empty($permissionDetails['id'])) {{$permissionDetails->id}} @endif" value="@if(!empty($permissionDetails['name'])) {{$permissionDetails->name}} @endif" placeholder="Enter Permission Title">
                  </div>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" style="float:right;" id="submit-btn">Submit</button>
      </div>
        <!-- <div class="modal-footer justify-content-between"></div> -->
        {!! Form::close() !!}
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>