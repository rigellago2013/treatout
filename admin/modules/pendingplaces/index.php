<link rel="stylesheet" type="text/css" href="modules/pendingplaces/places.css">

<div id="heading" >
	<h1> 
		Pending places
	</h1>
</div>

<div class='inner'>
	<div class='highlights'>	
			<table style="width:100%">
  <tr>
    <th>Type</th>
    <th>Name</th> 
    <th>Address</th>
    <th>Price rate</th>
    <th>Action</th>
  </tr>
<?php

$list = $places->getPendingPlaces();

if($list) {

foreach ($list as $value) {
	
echo "

  <tr>
    <td>$value->type</td>
    <td>$value->name</td> 
    <td>$value->address</td>
    <td>$value->rate_max </td>
     <td><button type='button' class='btnapprove' id='$value->place_id'> Approve </button> &nbsp; <button type='button' class='btncancel' id='$value->place_id'> Cancel </button> </td>
  </tr>


";
}

}

?>
</table>
	</div>
</div>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){

	$(document).on('click', '.btnapprove', function(){

		var place_id = $(this).attr("id");
		$.ajax({
			url:"modules/pendingplaces/approve.php",
			method:"POST",
			data:{place_id:place_id},
			dataType:"JSON",
			success:function(data)
			{
				alert(data.msg)
				window.location.reload()
			}
		})
	});//click ka update pre

	$(document).on('click', '.btncancel', function(){

		var place_id = $(this).attr("id");
		$.ajax({
			url:"modules/pendingplaces/cancel.php",
			method:"POST",
			data:{place_id:place_id},
			dataType:"JSON",
			success:function(data)
			{
				alert(data.msg)
				window.location.reload()
			}
		})
	});//click ka update pre




});
</script>