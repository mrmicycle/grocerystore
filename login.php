<?php
  // password error message, checks for ?pass in url
  if (isset($_GET['pass']))
  {
    echo "<h4>password is incorrect!</h4>";
  }
  else if (isset($_GET['user']))
  {
    echo "<h4>user does not exist!</h4>";
  }
  // if the cookie exists,
  if (isset($_COOKIE["toni_"]))
  {
    // set the first item of cookie as user
    $user = $_COOKIE["toni_"][0];
    // welcome user
    echo "You already logged in. Weclome back $user<br>";
    echo "<a href='store.php'>Back to store?</a>";
  }
  else if (isset($_COOKIE["admin_"]))
  {
    $user = $_COOKIE["admin_"][0];
    echo "You already logged in. Welcome back $user<br>";
    echo "<a href='admin.php'>Back to admin page?</a><br>";
    echo "<a href='store.php'>Back to store?</a><br>";
  }
  // if cookie does not exist,
  else 
  {
    // show login page.
    // on submit, form will send person to processlogin.php where a cookie will be created.
    echo 
    "
    <h2>Login:</h2>
    <form method='POST' action='./processlogin.php'>
      <label for='email'>email:</label><br>
      <input type='text' id='email' name='user[]' value='jane@doe.com'><br>
      <label for='password'>password:</label><br>
      <input type='text' id='password' name='user[]'>
      <br><br>
      <input type='submit' value='Submit'>
      <!-- processlogin will take the user data and make a cookie. -->
    </form>
    <a href='store.php'>Back to store?</a> 
    ";
  }

      /* <label for='username'>username:</label><br>
      <input type='text' id='username' name='user[]' value='J'><br> 
      code for username taken out*/
?>

