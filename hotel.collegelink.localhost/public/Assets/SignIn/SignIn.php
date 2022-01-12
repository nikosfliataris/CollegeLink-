<?php 
require __DIR__. '/../../../Boot/Boot.php';
use Hotel\User;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="SignIn.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <script src="SignIn.js"></script>
    <title>SignIn</title>
  </head>
  <body>
    <section class="SignIn">
      <div>
        <form method="post" action="/public/actions/signin.php">
          <label for="e-mail">E-mail:</label>
          <input
            type="input"
            id="email"
            name="email"
            class="email"
            placeholder="E-mail"
          />
          <div class="text-danger email-error">
            Must be a valid e-mail address
          </div>
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="password"
            placeholder="Password"
          />
          <div class="text-danger password-error">
            Must be a valid e-mail password
          </div>
          <button type="submit" class="SignIn-Btn" disabled>Sign In</button>
        </form>
      </div>
      <div class="register-info">
        <span>Create an Account:<a href="/public/Assets/Register/Register.php">Register</a></span>
        </div>
    </section>
  </body>
</html>
