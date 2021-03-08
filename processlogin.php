<?php
    // on user submit, their information is passed to this file.
    // user will never see this page. This just processes information and redirects.
    $email = $_POST['user'][0];
    $password = $_POST['user'][1];

    // checking if the password is correct.
    if ($password != "123")
    {
        // if password is incorrect, send the user back to login
        // along with ?pass. This is checked for at the beginning
        // of the login page.
        header("Location:login.php?pass");
    }
    else 
    {
        // create cookies if the password is correct.
        // cookie only valid for 2 minutes.


        // check username
        if ($email == "admin@admin.com")
        {
            // set cookie
            setcookie("admin_[0]", $email, time() + 120);
            // send to admin page
            header("Location:admin.php");
        }
        else if ($email =="toni@toni.com")
        {
            // set cookie
            setcookie("toni_[0]", $email, time() + 120);
            // send to store page
            header("Location:store.php");
        }
        else
        {
            // send user back to login with message saying that user does not exist!
            header("Location:login.php?user");
        }
    }
?>