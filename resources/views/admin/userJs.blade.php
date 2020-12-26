<script>
// for user list data table code
  $(function () {
    $("#example1").DataTable();
    $("#example3").DataTable();
    $("#example4").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>
// verfy email type 
   function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( $email );
   }
</script>

<script>
// update status active and inactive 
 function UpdateStatus(id, status,type){
    $('#enable'+id).html("<i class='fas fa-spinner fa-pulse'></i>")
    $.ajax({
          dataType: "json",
          type: "post",
          url: "{{url('set-status')}}",
          data:  { "_token": "{{ csrf_token() }}", id: id, status: status, type: type },
          success: function (data) {
            if(data.code != 200){
              toastr.error('Status Not Updated.')
            }else{
              if( data.updateStatus === '1'){
                $('#enable'+id).html("<button type='button' id='enable' onclick='UpdateStatus(\""+id+"\", \"0\",\""+type+"\")' class='btn btn-success'>Active</button>")
                toastr.success('Status Update Succesfully.')
            }else{
                $('#enable'+id).html("<button type='button' id= 'disable' onclick='UpdateStatus(\""+id+"\", \"1\",\""+type+"\")' class='btn btn-danger'>Inactive</button>")
                toastr.success('Status Update Succesfully.')    
            }
            }    
        }
    });
  };
</script>

<script>
// update status of booking dates active and inactive 
 function UpdateBookingStatus(id, status,type){
    $('#active'+id).html("<i class='fas fa-spinner fa-pulse'></i>")
    $.ajax({
          dataType: "json",
          type: "post",
          url: "{{url('set-booking-status')}}",
          data:  { "_token": "{{ csrf_token() }}", id: id, status: status, type: type },
          success: function (data) {
            if(data.code != 200){
              toastr.error('Status Not Updated.')
            }else{
              if( data.updateStatus === '1'){
                $('#active'+id).html("<button type='button' id='active' onclick='UpdateBookingStatus(\""+id+"\", \"0\",\""+type+"\")' class='btn btn-success'>Booking On</button>")
                toastr.success('Status Update Succesfully.')
            }else{
                $('#active'+id).html("<button type='button' id= 'inactive' onclick='UpdateBookingStatus(\""+id+"\", \"1\",\""+type+"\")' class='btn btn-danger'>Booking Off</button>")
                toastr.success('Status Update Succesfully.')    
            }
            }    
        }
    });
  };
</script>
<script>
// for required field in all input boxes
$(document).on('keyup', '.required_field', function(){
  var id = $(this).attr("id");
  setRequired(id);
  
});
$(document).on('change', '.required_field_select', function(){
  var id = $(this).attr("id");
  setRequired(id);  
});

function setRequired(id){
  var idVal = $('#'+id).val();
   if(id == 'email'){
      if(!validateEmail($('#email').val())) {
        $("#email_errors").html("Please Enter a Valid Email Address.");
        $('.user_submit').attr('disabled', 'disabled');
      }else{
        $("#email_errors").html('');
        $('.user_submit').removeAttr('disabled', 'disabled');
         $.ajax({
            type: "POST",
            url: "{{url('check-email')}}",
            dataType: "json",
            data: {
               "_token": "{{ csrf_token() }}",
               'email' : $('#email').val(),
               'user_id' : $('#userId').val()
            },
            dataType: 'json',
            success: function(data) {
               if(data.status == false){
                $("#email_error").html('This Email Already Exist.'); 
                $('.user_submit').attr('disabled', 'disabled');
               }else{
                $("#email_error").html('');
                $('.user_submit').removeAttr('disabled', 'disabled');
               }
            },
         });
      }
   }
  if(idVal == ''){
    $('#'+id).addClass('is-invalid');
    return false;
  }else{
    $('#'+id).removeClass('is-invalid');
    return true;
  }

}
$(document).on('click', '#submit-btn', function(){
  var errorArray = [];
  var errorOnSubmit =  $('#errorOnSubmit').val();
  if(errorOnSubmit == ''){
    $('.required_field').each(function(){
        var id = $(this).attr("id");
        var status = setRequired(id);
        if(status == false){
          errorArray.push(id);
        }        
      });
      if(errorArray.length){
        toastr.error('Please fill All Input Forms'); 
      }else{
        $("#submit").trigger("click");
        $("#order_submit").trigger("click");
      }
    
  }else{
    toastr.error('Please change Name beacuse This Name already Exist.'); 
  }  
 
});
</script>

<script>
// for unique value check data from database 
$(document).on('keyup', '.unique_entry', function(){
  var editId = $(this).attr("data-edit");
  if(editId == ''){
      editDataId = '0';
  }else{
    editDataId = editId;
  }
  //alert(editDataId);
  var inputValue = $(this).val();
  var tableName = $(this).attr("data-table");
  $.ajax({
      type: "POST",
      url: "{{url('check-unique-entry')}}",
      dataType: "json",
      data: {
          "_token": "{{ csrf_token() }}",
          'inputValue' : inputValue,
          'tableName'  : tableName,
          'editDataId'  : editDataId
      },
      dataType: 'json',
      success: function(data) {
          if(data.status == false){
           $('#errorOnSubmit').val('1');
           $("#name_error").html('This Name Already Exist.');
          $('#submit-btn').attr('disabled', 'disabled');  
          }else{
            $('#errorOnSubmit').val('');
            $("#name_error").html('');
            $('#submit-btn').removeAttr('disabled', 'disabled');
          }
      },
        });
});
</script>

<script>
$(".alphaonly").keypress(function(event){
    var inputValue = event.charCode;
    if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32) || (inputValue==0))){
        event.preventDefault();
    }
});
</script>

<script>
// $(document).on('keyup', '#day', function(){
// var minNumber = +$('#night').val();
// var maxNumber = +$('#day').val();
//   if(maxNumber == minNumber+1){
//     $("#max_error").html('');
//     $('.tour-submit').removeAttr('disabled', 'disabled');
//   }else{
//     $("#max_error").html("Please Insert Max Days From Nights");
//     $('.tour-submit').attr('disabled', 'disabled');
//   }
// });

$("#night").keyup(function(){
    var day = +$(this).val();
    var days = day+1;
    $("#day").val(days);        
});
</script>

<script>
$(document).on('keyup', '.chck_max_days', function(){
var minNumber = +$('#min_days').val();
var maxNumber = +$('#max_days').val();
if(minNumber != '' && maxNumber!= ''){
      if(minNumber < maxNumber){
        $("#max_error2").html('');
        $('.tour-submit').removeAttr('disabled', 'disabled');
      }else{
        $("#max_error2").html("Please Insert Max Booking Days From Min Booking Days");
        $('.tour-submit').attr('disabled', 'disabled');
      }
    } 
});
</script>

<script>
$(document).on('click','#refresh',function(){
  location.reload();
});
</script>