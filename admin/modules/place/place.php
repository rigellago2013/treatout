<?php
$module = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$place = (isset($_GET['place']) && $_GET['place'] != '') ? $_GET['place'] : '';
$placename = (isset($_GET['name']) && $_GET['name'] != '') ? $_GET['name'] : '';

?>
<link rel="stylesheet" type="text/css" href="modules/place/place.css">

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

                    <a id="url" href="index.php?mod=terminal&place_id=<?php echo $_GET['place'] ?>&name=<?php echo $_GET['placename']?>&lng=<?php echo $_GET['lng']?>&lat=<?php echo $_GET['lat']?>" class="button primary icon fa-map" class="button primary icon fa-map">Terminals</a>

                    <?php


                            $res = $places->checkPlace($place);

                            if($res == 0) {

                                echo  '<button type="button" id="btn-add" data-toggle="modal" data-target="#annModal" class="button primary icon fa-map">Add Details</button></h3>';




                            } else {

                                echo  '<button type="button" id="'.$place.'" data-toggle="modal" data-target="#annModal" class="btn-edit button primary icon fa-map">Edit</button></h3>';
                            }

                    ?>
            
                    <button type="button" id="btn-tag" data-toggle="modal" data-target="#tagModal" class="button primary icon fa-map">Add Tag</button></h3>

            </div>
                     <div class="content">
            <h2> Tags</h2>

                <?php 

                    $tags = $places->getTags($_GET['place']); 

                    if(count($tags)) {

                        foreach ($tags as $value) {
                            echo " <li class='button primary small'>$value->tag_name </li>";
                        }
                    }

                ?>
            
            <br/>
        </div>
        </div>
        <div class="inner">
            <div class="content">
            <h2>Gallery</h2>
            <span id="imageReference"></span>
            <br/>
            </div>
        </div>

    <div class="inner">
        <div class="content">
            <h2> Reviews</h2>

            <span id="reviews">
            </span>
            <br/>
        </div>
    </div>



    
    
</div>

<div id="detailsModal" class="modal">
    <div class="modal-content">
           <div class="modal-header">
            <span class="close">&times;</span>
            <h3>Add details</h3>
        </div>

        <div class="modal-body">
            <form method="post" id="user_form" enctype="multipart/form-data">

                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo $_GET['placename']; ?>" readonly><br>
                    <br>
                    <label>PriceRate</label>
                    <input type="number"  step="0.00" name="maxrate" id="maxrate" class="form-control" />
                    <br>         
                
        </div>
        <div class="modal-footer">
            <input type="hidden" name="place_id" id="placeid" value="<?php echo $place; ?>" />
            <input type="submit" name="action" id="action" value="Add" />
        </div>
    </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
           <div class="modal-header">
            <span class="closeedit">&times;</span>
            <h3>Edit details</h3>
        </div>

        <div class="modal-body">
            <form method="post" id="edit_form" enctype="multipart/form-data">
                    <label>Price rate</label>
                    <input type="number"  step="0.00" name="maxrate" id="maxrateedit" class="form-control" />
                    <br>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="placeid" id="placeid" value="<?php echo $place; ?>" />
            <input type="submit" name="action" id="action" value="Submit" />
        </div>
    </form>
    </div>
</div>

<div id="tagModal" class="modal">
    <div class="modal-content">
           <div class="modal-header">
            <span class="closetag">&times;</span>
            <h3>New Tag</h3>
        </div>

        <div class="modal-body">
            <form method="post" id="tagform" enctype="multipart/form-data">
                    <label>Tag name</label>
                    <input type="text" name="tagname" id="tagname" class="form-control" />
                    <br>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="placeid" id="placeid" value="<?php echo $place; ?>" />
            <input type="submit" name="action" id="action" value="Submit" />
        </div>
    </form>
    </div>
</div>

<script src="modules/place/place.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    // Get the modal
var modal = document.getElementById('detailsModal');
var modaledit = document.getElementById('editModal');
var tagModal = document.getElementById('tagModal');


// Get the button that opens the modal

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var spanedit = document.getElementsByClassName("closeedit")[0];
var spantag = document.getElementsByClassName("closetag")[0];


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

spanedit.onclick = function() {
    modaledit.style.display = "none";
}


spantag.onclick = function() {

    tagModal.style.display = "none";
}


$(document).on('click', '#btn-add', function(event) {

      modal.style.display = "block";
});

$(document).on('click', '#btn-tag', function(event) {

      tagModal.style.display = "block";
});



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

window.onclick = function(event) {
    if (event.target == modaledit) {
        modaledit.style.display = "none";
    }
}

window.onclick = function(event) {
    if (event.target == tagModal) {
        tagModal.style.display = "none";
    }
}

$(document).on('submit', '#user_form', function(event){
        event.preventDefault();

        var maxrate = $('#maxrate').val();

            if(maxrate !='')
            {
                $.ajax({
                    url:"modules/place/insert.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    dataType: 'JSON',
                    success:function(data)
                    {
                        alert(data.msg);
                        $('#user_form')[0].reset();
                         modal.style.display = "none";
                         location.reload();
                    }
                });
            }
            else
            {
                alert("Please fill up required information!");
            }
});


$(document).on('submit', '#tagform', function(event){
        event.preventDefault();

       
                $.ajax({
                    url:"modules/place/addtag.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    dataType: 'JSON',
                    success:function(data)
                    {
                        alert(data.msg);
                        $('#tagform')[0].reset();
                         modal.style.display = "none";
                         location.reload();
                    }
                });
       
});


$(document).on('submit', '#edit_form', function(event){
        event.preventDefault();

        var minrate = $('#minrateedit').val();
        var maxrate = $('#maxrateedit').val();

            if(minrate != '' && maxrate !='')
            {
                $.ajax({
                    url:"modules/place/update.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    dataType: 'JSON',
                    success:function(data)
                    {
                        alert(data.msg);
                        tagModal.style.display = "none";
                        location.reload();
                    }
                });
            }
            else
            {
                alert("Please fill up required information!");
            }
});


$(document).on('click', '.btn-edit', function(){

        var placeid = $(this).attr("id");
        
        $.ajax({
            url:"modules/place/getDetails.php",
            method:'POST',
            data:{placeid:placeid},
            dataType:"JSON",
            success:function(data)
            {
                modaledit.style.display = "block";
                $('#minrateedit').val(data.minrate);
                $('#maxrateedit').val(data.maxrate);
        }
    })
});





});   

</script>   