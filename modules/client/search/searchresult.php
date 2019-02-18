<div class="inner">
  <div class="content">

 <table>
    <tr>
        <th>Name</th>
        <th>Price rate</th>
        <th>Action</th>
    </tr> 
<?php
  if($list= $places->search($_POST['searchvalue'], $_POST['maxrate'])) {

  foreach ($list as $value) {
echo "
  
    <tr>
        <th>$value->name</th>
        <th>Php$value->rate_max</th>
        <th><a href='index.php?mod=places&place=$value->place_id&placename=$value->name&address=$value->address&img=$value->image&contact=$value->contact&lat=$value->latitude&lng=$value->longitude' class='inline'> View</a>

</th>
    </tr> 


    ";
  }
} else 
  echo "<p style='margin-left: 47%;'> No results found.. </p>"
?>
  </table> 
  
  </div>

</div>
