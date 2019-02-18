<?php

$module = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$place = (isset($_GET['place']) && $_GET['place'] != '') ? $_GET['place'] : '';
$name = (isset($_GET['name']) && $_GET['name'] != '') ? $_GET['name'] : '';

?>
<link rel="stylesheet" type="text/css" href="modules/client/place/place.css">

<section id="main" class="wrapper">
    <div class="inner">
        
            <div class="content">
            <h1><b id="title"><?php if(isset($_GET['placename'])){ echo $_GET['placename']; } ?></b></h1>
            <h2><b id="rating"></b></h2>

            <ul class="alt">
                <li id="description"><?php if(isset($_GET['address'])){ echo $_GET['address']; } ?></li>
                <li id="phoneNum"><?php if(isset($_GET['contact'])){ echo $_GET['contact']; } ?></li>
                <li> Estimated rate: <?php $res = $places->show($place); foreach ($res as $value) {
                    echo $value->rate_max;
                } ?>  </li>
                <li id="avail"></li>

            </ul>

  <a id="url" href="index.php?mod=terminal&place_id=<?php echo $_GET['place'] ?>&name=<?php echo $_GET['placename']?>&lng=<?php echo $_GET['lng']?>&lat=<?php echo $_GET['lat']?>" class="button primary icon fa-map">Public Transportation Routes</a>
            <br>
            <br>
        <label>Rate this place  </label>
        <select name="rate" id="rating" style="width: 10%;" required>
          <option>
         1
          </option>
            <option>
         2 
          </option>
                <option>
         3
          </option>
                <option>
         4
          </option>
                <option>
         5
          </option>
        </select>
            </div>

         <div class="content">
            <h2> Tags</h2>

                <?php 

                    $tags = $places->getTags($_GET['place']); 

                    if(count($tags)) {

                        foreach ($tags as $value) {
                            echo " <li class='button primary small' style='margin-top: 10px;'>$value->tag_name </li>";
                        }
                    }

                ?>
            
            <br/>
        </div>
        </div>
        <div class="inner">
            <div class="content">
            <h2>Gallery</h2>
            <span id="imageReference">
              <img style="width: 60%;" src="<?php echo $_GET['img']?>">
            </span>
            <br/>
            </div>
        </div>

        <?php

        if(isset($_GET['placename'])) {

        } else {
          echo "
                <div class='inner'>
            <div class='content'>
            <h2> Reviews</h2>

            <!-- Reviews -->
            <span id='reviews'>
            </span>
            <br/>
        </div>
        ";
        }
  

        ?>

         </div>

         <div class="inner">

        <div class="content">
            <h2> Comments</h2>
            <span id="comments">
            </span>
            <br/>
        </div>
             
         </div>

         <div class="inner">
        <?php

            if(!empty($_SESSION['id']))

            echo "<div class='content'>
                        <h2> Post a comment</h2>
                    <form method='POST' id='commentForm'>
                        <input type='text' name='comment' required>
                        <br>
                        <input type='submit' name='submit'>
                        <input type='hidden' name='placeid' value= '".$_GET['place']."'>
                        <input type='hidden' name='userid' value= '".$_SESSION['id']."'>
                    </form>
                </div> ";

        ?>
         </div>


   
</div>

<script src="modules/client/place/place.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $(document).on('submit', '#commentForm', function(event) {
    event.preventDefault();
      $.ajax({
        url:"/modules/client/place/addcomment.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType: 'JSON',
        success:function(res)
        {
          if(res.msg){

            alert(res.msg)
            location.reload()

          }else{

              alert("ERROR")
          }
        }
      });
  });

    $("#rating").change(function() {
       $(this).val() // how to get the value of the selected item if you need it
             $.ajax({
        url:"/modules/client/place/rateplace.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType: 'JSON',
        success:function(res)
        {
          if(res.msg){

            alert(res.msg)
            location.reload()

          }else{

              alert("ERROR")
          }
        }
      });

    });


});
</script>