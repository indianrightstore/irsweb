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
                <h3 class="card-title"> Order Products</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="order_product">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary d-none" style="float:left;" id="submit">Submit</button>
              <input type="hidden"  name="errorOnSubmit" id="errorOnSubmit"  value="">
              <input type="hidden"  name="retailer_id" id="retailer_id"  value="{{$orderDetails->id}}">
              <input type="hidden"  name="store_id" id="store_id"  value="{{$orderDetails->store_id}}">
                <div class="card-body">
				  <div class="row">
				  <div class="form-group col-md-6">
                   <label for="exampleInputPassword1"> Select Category*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="category_id" id="category_id">
                        <option value="">Select Category Name</option>
                        @foreach($category as $categoryValue)
                        <option value="{{$categoryValue->id}}">{{$categoryValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
				<div class="form-group col-md-6">
                   <label for="exampleInputPassword1"> Select Brand Name*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="brand_id" id="brand_id">
                        <option value="">Select Brand Name</option>
                        @foreach($brand as $brandValue)
                        <option value="{{$brandValue->id}}">{{$brandValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  </div>
				<div class="row">
                  <div class="form-group col-md-6">
                   <label for="exampleInputPassword1"> Select Product*</label>
                    <select for="status" class="form-control select  required_field required_field_select" name="product_id" id="product_id">
                        <option value="">Select Product Name</option>
                        @foreach($product as $productValue)
                        <option value="{{$productValue->id}}">{{$productValue->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Product Quantity*</label>
                    <input type="number" class="form-control required_field" step="any" name="product_quantity" id="product_quantity" data-table="product" placeholder="Enter Product Quantity">
                  </div>
				  </div>
				  <div class="row">
				  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Product MRP*</label>
                    <input type="number" class="form-control required_field bill" step="any" name="product_mrp" id="product_mrp" data-table="product" value="" placeholder="Enter MRP Price" readonly>
                  </div>
				  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Product Actual Price*</label>
                    <input type="number" class="form-control required_field bill" step="any" id="product_actual_price" data-table="product" value=""  readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Discount on Product(%)*</label>
                    <input type="number" class="form-control required_field bill" step="any" name="discount" id="discount" data-table="product" placeholder="Enter Discount on Product">
                  </div>
				  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Discount IRS Got(%)*</label>
                    <input type="number" class="form-control required_field bill" step="any" id="discount_got" data-table="product" placeholder="Enter Discount on Product" readonly>
                  </div>
                  </div>
					<div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Total Ammount</label>
                    <input type="number" class="form-control required_field" step="any" name="ammount" id="ammount" data-table="product" placeholder="Total Ammount" readonly>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary" id="submit-btn-1" style="float:right;">Submit</button>
                </div>
                </form>
            </div>
			<div class="col-md-12" style="padding: 12px;">
            <!-- general form elements -->
            <div class="card card-primary">
            <div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Store Name</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Quantity</th>
                  <th>Product MRP</th>
                  <th>Product Discount</th>
                  <th>Total Ammount</th>
                  <th>P.V</th>
                  <th>B.V</th>
                </tr>
                </thead>
                <tbody>
			   @if(!empty($orderProductDetails))
               @foreach($orderProductDetails as $orderProductDataVal)
                <tr>
                  <td>{{$orderProductDataVal->store_name}}</td>
                  <td>{{$orderProductDataVal->category_name}}</td>
                  <td>{{$orderProductDataVal->product_name}}</td>
                  <td>{{$orderProductDataVal->product_quantity}}</td>
                  <td>{{$orderProductDataVal->product_mrp}}</td>
                  <td>{{$orderProductDataVal->discount}}</td>
                  <td>{{$orderProductDataVal->total_ammount}}</td>
                  <td>{{$orderProductDataVal->pv}}</td>
                  <td>{{$orderProductDataVal->bv}}</td>
                </tr>
               @endforeach
			   @endif
                </tbody>
              </table>
				</div>
				</div>
				</div>
            <!-- /.card -->
          </div><!--/.col (right) -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$('.bill').on('keyup',function(){
	var quantity = $('#product_quantity').val();
	var price = $('#product_mrp').val();
	var discount = $('#discount').val();
		if(price != ''){
			var Total = quantity*price;
			$('#ammount').val(Total);
			}
		if(discount != '' && price != ''){
			var totalAmt = quantity*price;	
			var margin = totalAmt*discount/100;
			var Total = totalAmt-margin;
			$('#ammount').val(Total);
			}
	
});

// submit form
$('#submit-btn-1').on('click',function(){
	$.ajax({
        url: "{{url('submit-order-product')}}",
        type: 'post',
        dataType: 'json',
        data: $('form#order_product').serialize(),
        success: function(data) {
			toastr.success('Your Order Submit Succesfully.')
                   location.reload();
                 }
    });
});

// product data value
$('#product_id').on('change',function(){
	var product_id = $('#product_id').val();
	 $.ajax({
        url: "{{url('get-product-value')}}",
        type: 'post',
        dataType: 'json',
        data:  { "_token": "{{ csrf_token() }}", product_id: product_id},
        success: function(data) {
			if(data.code == 200){
				$('#product_mrp').val(data.productData.market_price);
				$('#product_actual_price').val(data.productData.price);
				$('#discount_got').val(data.productData.discount);
			}else{
				console.log("Server Error");
			}

                 }
    });
});


</script>
@endsection
@push('js')
@include('admin.userJs')
@endpush
