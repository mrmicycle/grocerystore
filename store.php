<?php
    
    // this will pop up at the top of the store if there are no items selected when going to cart.
    if (isset($_GET['select']))
    {
        echo "<h4>no items selected!</h4>";
    }
    // code here to look for cookies
    if (isset($_COOKIE["toni_"]))// if the cookie exists,
    {
        // set the first item of cookie as username
        $user = $_COOKIE["toni_"][0];
        // welcome user
        echo "Weclome, $user<br>";
    }
    else if (isset($_COOKIE["admin_"]))
    {
        $user = $_COOKIE["admin_"][0];
        echo "Welcome $user<br>";
        // admin link only shows for admin
        echo "<a href='admin.php'>Back to admin page?</a><br>";
    }
    
    // if toni cookie, show user "welcome tony"

    // read from associative array for current fruit prices.
    $filename = "./data.txt";
    $file = fopen($filename, "r") or die("Unable to open file!");//or die statement for errors.
    $data_assoc = array();

    // loop takes data from file and puts it in associative array
    while(!feof($file))
        {
            // each line of string on the opened text file to $line
            $line = fgets($file);
            if ($line == "")
            {
                continue;
                // dont add another key if you are on a blank line.
            }
            // create an array that has key and value in one array, key is [0] value is [1]
            $key_value = explode(" ", $line);
            // add key and value to $data_ky associative array.
            $data_assoc[$key_value[0]] = $key_value[1];         
        }

    // all html is echoed out so I can edit it with php!
    echo 
    "<html>" .
        "<body>" .
            "<a href='login.php'>login </a><br>" .
            "<a href= 'cart.php?nowrite'>cart </a><br>" .
            "<h1>FOOD FOR LESS</h1>" . 
            "<form action='cart.php' method='POST'>" . 
                "<table>";

                    // loop to print out each item using data from text file
                    foreach($data_assoc as $key => $value) 
                    {
                        echo
                        "<tr>" .
                        "<td> <input type=checkbox name='item[]' value='$key $value'><img src='$key' height =100 widt=100> </td>" .
                        "<td> Price: $$value</td>" .
                        "</tr>";
                    }
    echo
                "</table>" .
                "<input type=submit value='add to cart'>" .
            "</form>" .
        "</body>" .
    "</html>";

    echo "<br><br><br>";
    // close file after use
    fclose ($file);


?>

