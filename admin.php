<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Eco de Residencia | ADMIN</title>
    <link rel="stylesheet" href="css/styleadmin.css">
  </head>
  <body>
    <div class="center">
      <h2><img src="images/logo2.png" width="100px" height="100px"><br><font color="#688F4E">Eco de Residencia</font></h2>
      <h1>ADMIN</h1>
      <form action="includes/admin-login-inc.php" method="post">
        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" name="submit" value="Login">
        <div class="signup_link">
          Not an admin? <a href="login.php">Login as user</a>
        </div>
      </form>
    </div>
  </body>
</html>
