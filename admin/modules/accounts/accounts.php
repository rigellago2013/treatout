<link rel="stylesheet" type="text/css" href="modules/transportation/transportation.css">
<div id="heading" >
	<h1> 
		User Accounts
	</h1>
</div>
<br>




<div class='inner'>
	<div class='highlights'>	
<?php

$list = $user->getAll();

foreach ($list as $value) {
	
echo "
		<section>
		    <div class='content card'>
		      <header>
		        <h3>$value->name</h3>
		      </header>
		
		      <p>$value->email</p>
		      

		      <button id='$value->id' type='button' class='btn-edit' >Edit</button>
		    </div>


		</section>
";
}

?>
	</div>
</div>