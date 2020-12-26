<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script>
$(document).on('change', '.get_state', function(){
	var country_id = $('.get_state').val();
	 $.ajax({
          dataType: "json",
          type: "post",
          url: "{{url('get-state')}}",
          data:  { "_token": "{{ csrf_token() }}", country_id: country_id},
          success: function (data) {
                if(data.code == 200){
					$.each(data.stateData, function( statekey, statevalue ) {
					  var statehtml = '<option value='+statevalue.id+'>'+statevalue.name+'</option>';
					  $('#state_id').append(statehtml);
					});
				}else{
					console.log("State not Found For this country");
				}
        }
    });
  
});

// get city
$(document).on('change', '.get_city', function(){
	var state_id = $('.get_city').val();
	 $.ajax({
          dataType: "json",
          type: "post",
          url: "{{url('get-city')}}",
          data:  { "_token": "{{ csrf_token() }}", state_id: state_id},
          success: function (data) {
                if(data.code == 200){
					$.each(data.cityData, function( citykey, cityvalue ) {
					  var cityhtml = '<option value='+cityvalue.id+'>'+cityvalue.name+'</option>';
					  $('#city_id').append(cityhtml);
					});
				}else{
					console.log("City not Found For this state");
				}
        }
    });
  
});
</script>