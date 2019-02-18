<link rel="stylesheet" type="text/css" href="modules/transportation/transportation.css">
<div id="heading" >
	<h1> 
		Transportations
	</h1>
</div>
<br>
<button style="margin-left: 20px;" type="button" id="btn-add" data-toggle="modal" data-target="#annModal" class="button primary">New Transportation</button></h3>



<div class='inner'>
	<div class='highlights'>	
<?php

$list = $transportation->getAll();

foreach ($list as $value) {
	
echo "
		<section>
		    <div class='content card'>
		      <header>
		        <h3>$value->trans_name</h3>
		      </header>
		
		      <p>$value->description</p>
		      

		   
		    </div>


		</section>
";
}

?>
	</div>
</div>



<div id="transpoModal" class="modal">
    <div class="modal-content">
           <div class="modal-header">
            <span class="close">&times;</span>
            <h3>New Transportation</h3>
        </div>

        <div class="modal-body">
            <form method="post" id="transpoform" enctype="multipart/form-data">
                    <label>Name</label>
                    <input type="text" name="name" id="tagname" class="form-control" />
                    <br>

                    <label>Description</label>
                    	<input type="text" name="desc" id="tagname" class="form-control" />
                    <br>
        </div>
        <div class="modal-footer">
    
            <input type="submit" name="action" id="action" value="Submit" />
        </div>
    </form>
    </div>
</div>



<script type="text/javascript">

$(document).ready(function(){

var modal = document.getElementById('transpoModal');

var span = document.getElementsByClassName("close")[0];

span.onclick = function() {

    modal.style.display = "none";

}

$(document).on('click', '#btn-add', function(event) {

      modal.style.display = "block";
});


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$(document).on('submit', '#transpoform', function(event){
        event.preventDefault();

                $.ajax({
                    url:"modules/transportation/insert.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    dataType: 'JSON',
                    success:function(data)
                    {
                        alert(data.msg);
                        $('#transpoform')[0].reset();
                         modal.style.display = "none";
                         location.reload();
                    }
                });
           
      
});

});

</script>