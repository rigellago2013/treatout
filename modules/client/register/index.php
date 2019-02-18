<div class="logincontainer" >
    <section>
        <div class="loginform">
          <header>
            <h3>Register</h3>
          </header>
 <form method="POST" id="register">
  <input type="text" name="fname" placeholder="First name" required>

  <br>
  <input type="text" name="lname" placeholder="Last name" required>
  <br>
  <input name="email" type="email" placeholder="Email" size="30" required title="Must be a  email address">
  <br>
  <input id="password" type="password" name="password" placeholder="Password" required>
  <br>
  <input id="confirmPassword" type="password" name="confirmpassword" placeholder="Please retype your password here." required> 
  <span id="verify"></span>
  <br>
  <div class="g-recaptcha" data-sitekey="6LfcT28UAAAAANGMbzeJO6Wi4cO0ID8SSukQ881K" data-callback="captchaCallback"></div>
  <br/>
  <input id="submit" type="submit">
</form>
        </div>
  </section>
</div>
<script src="modules/client/register/register.js"></script>

