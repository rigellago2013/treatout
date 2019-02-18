<?php
$module = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$service = (isset($_GET['service']) && $_GET['service'] != '') ? $_GET['service'] : '';

$min = (isset($_GET['min']) && $_GET['min'] != '') ? $_GET['min'] : '';
$max = (isset($_GET['max']) && $_GET['max'] != '') ? $_GET['max'] : '';


?>
<link rel="stylesheet" type="text/css" href="modules/places/places.css">

<div id="heading" >
	<h1> 
	<?php
	
	if( $service == 'tourist spot' || $service == 'restaurant')
	{
		echo $service;

	} else {

		echo "Search"; 

	}
	?>
	</h1>
</div>

<div class="inner">
	<div class="highlights" id="placeLists">	
	</div>

			<?php 

			$list = $places->getByType($service);

			if($list) {

			foreach ($list as $value) {

			?>
			<div class="highlights"> <section>
				<div class="content card" onclick="goToPage('index.php?mod=places&place=<?php echo $value->place_id."&placename=".$value->name."&address=".$value->address."&img=".$value->image."&contact=".$value->contact."&lat=".$value->latitude."&lng=".$value->longitude?>')">
					          <header>
					            <h3><?php echo $value->name ?></h3>
					          </header>
					          <h2>★★★★☆</h2>
					          <p><?php echo $value->address ?></p>
					        </div>
			</section> </div>
			<?php
				}
			}
		?>
</div>

<div id="buttons">
</div>

<script src="modules/places/places.js"></script>



