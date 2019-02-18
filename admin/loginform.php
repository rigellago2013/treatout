<div class="logincontainer" >
    <section>
        <div class="loginform">
          <header>
            <h3>Admin login</h3>
          </header>
          <form method="POST" id="login">
  <input type="text" name="email" placeholder="email">
  <br>
  <input type="password" name="password" placeholder="password">
  <br>
  <input type="submit">
</form>


        </div>
  </section>
</div>



<script type="text/javascript">
        $(document).ready(function(){
  $(document).on('submit', '#login', function(event) {
    event.preventDefault();
      $.ajax({
        url:"login.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType: 'JSON',
        success:function(res)
        {
          if(res.login){

            var link = "index.php"
            window.location.href=link


          }else{

              alert("Invalid login information.")
          }
        }
      });
  });
});
</script>

