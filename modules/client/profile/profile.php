<?php

  if(!empty($_GET['id'])) {

    $data = $users->getuser($_GET['id']);


    foreach ($data as $value) {
      


?>

<div class="logincontainer" >
    <section>
        <div class="loginform">
          <header>
            <h3>Profile</h3>
          </header>
 <form method="POST" id="profileform">
  <input type="text" name="name" placeholder="Full name" value="<?php echo $value->name; ?>" required >
  <br>
  <input type="text" name="email" placeholder="email" value="<?php echo $value->email;?>" required readonly>
  <br>
  <input type="password" id="password" name="password" placeholder="password" >
  <br>
  <input type="password" id="confirmpassword" name="confirmpassword" placeholder="confirm password" >
  <br>
  <input type="submit">

  <input type="hidden"  name="id" value="<?php echo $_GET['id']; ?>" required>
</form>
        </div>
  </section>
</div>

<?php

    }

  }

?>

<script type="text/javascript">

$(document).ready(function(){

  $(document).on('submit', '#profileform', function(event){
        event.preventDefault();


        var password = $('#password').val();
        var confirm = $('#confirmpassword').val();


            if(password === confirm )
            {
                $.ajax({
                    url:"modules/client/profile/edit.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    dataType: 'JSON',
                    success:function(data)
                    {
                        alert(data.msg);
                        location.reload();
                    }
                });
            }
            else
            {
                alert("Password doesnt match!");
            }
});

});   
  

</script>