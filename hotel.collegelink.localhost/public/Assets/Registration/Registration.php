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
    <link rel="stylesheet" href="Register.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <title>Document</title>
  </head>
  <body>
    <section class="Register">
      <div class="register-place">
        <form method="post" action="/public/actions/register.php">
          <label for="User-Name">User name:</label>
          <input
          name="name"
            type="text"
            id="User-Name"
            class="register-item"
            placeholder="User Name ...."
          />
          <label for="E-mail">E-mail:</label>
          <input
          name="email"
            type="email"
            id="E-mail"
            class="register-item"
            placeholder="E-mail ....."
          />
          <label for="Password">Password:</label>
          <input
          name="password"
            type="password"
            id="Password"
            class="register-item"
            placeholder="Password ....."
          />
          <button type="submit" class="register-btn">Register</button>
        </form>
      </div>
      
    </section>
  </body>
</html>
