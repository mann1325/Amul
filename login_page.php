<?php
require_once "helpers.php";
start_session_once();
require_once "remember_me.php";


if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="login page.css" />
    <style>
      .error { color: red; margin-top: 10px; text-align: center; }
    </style>
  </head>
  <body>
    <div>
      <a href="index.php"> <img src="home.png" width="50" /></a>
    </div>

    <div id="main">
      <form id="form" action="login_handler.php" method="POST">
        <header>
          <img
            src="logo.png"
            alt="amul logo"
            width="135px"
            class="logo"
          /><br />
        </header>

        <?php
          if (isset($_SESSION['login_error'])) {
              echo '<div class="error">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
              unset($_SESSION['login_error']); // Clear error after displaying
          }
        ?>

        <div class="single-input">
          <div class="input-wrapper">
            <input
              name="txt_User"
              type="email"
              id="txt_User"
              placeholder="👤Email"
              autocomplete="off"
              required
            />
          </div>
          <div class="input-wrapper">
            <input
              name="txt_Pass"
              id="txt_Pass"
              type="password"
              placeholder="🔒Password"
              autocomplete="off"
              required
            />
          </div>
        </div>

        <div style="text-align: center; margin-top: 15px;">
          <input type="checkbox" name="remember_me" id="remember_me">
          <label for="remember_me">Remember Me</label>
        </div>

        <br />
        <div id="login">
          <button type="submit">LOGIN</button>
        </div>
        <br /><br />
        <a class="registration" href="registration_page.php"
          >New User Register</a
        >
        <br /><br />
      </form>
    </div>
  </body>
</html>