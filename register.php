<?php include_once("header.php")?>

<div class="container">
<h2 class="my-3">Register new account</h2>

<!-- Create auction form -->
<form method="POST" action="process_registration.php">
  <div class="form-group row">
    <label for="accountType" class="col-sm-2 col-form-label text-right">Registering as a:</label>
	<div class="col-sm-10">
	  <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="accountType" id="accountBuyer" value="buyer" checked>
        <label class="form-check-label" for="accountBuyer">Buyer</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="accountType" id="accountSeller" value="seller">
        <label class="form-check-label" for="accountSeller">Seller</label>
      </div>
      <small id="accountTypeHelp" class="form-text-inline text-muted"><span class="text-danger">* Required.</span></small>
	</div>
  </div>

  <!--Country Input (Only UK)-->
  <div class="form-group row">
    <label for="country" class="col-sm-2 col-form-label text-right">Country from:</label>
  <div class="col-sm-10">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="country" id="countryUK" value="UK" checked>
        <label class="form-check-label" for="countryUK">UK</label>
      </div>
      <small id="accountTypeHelp" class="form-text-inline text-muted"><span class="text-danger">* Required.</span></small>
  </div>
  </div>

  <!--Username Input-->
  <div class="form-group row">
    <label for="username" class="col-sm-2 col-form-label text-right">Username</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        <small id="usernameHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <!--Email Input (Starter Code)-->
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label text-right">Email</label>
  	<div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        <small id="emailHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
  	</div>
  </div>

  <!--First Name Input-->
  <div class="form-group row">
    <label for="firstname" class="col-sm-2 col-form-label text-right">First Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
        <small id="firstnameHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <!-- Family Name Input -->
  <div class="form-group row">
    <label for="familyname" class="col-sm-2 col-form-label text-right">Family Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="familyname" name="familyname" placeholder="Family Name">
        <small id="familynameHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <!-- Tel Input -->
  <div class="form-group row">
    <label for="tel" class="col-sm-2 col-form-label text-right">Tel</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="tel" name="tel" pattern="[0-9]{1,}" placeholder="Telephone (Numbers Only)">
        <small id="telHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <!-- Address Input -->
  <div class="form-group row">
    <label for="address" class="col-sm-2 col-form-label text-right">Address</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
        <small id="addressHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <!-- Password Input (Starter Code)-->
  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label text-right">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" pattern=".{6,}" placeholder="Password (At least 6 characters.)">
      <small id="passwordHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>
  <div class="form-group row">
    <label for="passwordConfirmation" class="col-sm-2 col-form-label text-right">Repeat password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" placeholder="Enter password again">
      <small id="passwordConfirmationHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>
  <div class="form-group row">
    <button type="submit" class="btn btn-primary form-control" name="name_submit">Register</button>
  </div>
</form>

<!-- Added for the CSS-styled error message -->
<?php if (isset($_GET['error'])) : ?>
          <div class="error"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>
<!-- End for the CSS-styled error message -->

<div class="text-center">Already have an account? <a href="" data-toggle="modal" data-target="#loginModal">Login</a>

</div>
</html>
<?php include_once("footer.php")?>