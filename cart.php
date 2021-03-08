<?php
    // if manually clicking on cart, show the previously saved items.
    // check that something is clicked?
    
    if (isset($_GET['nowrite']))
    {
        // code to READ from file no writing
        if (isset($_COOKIE["toni_"]))
        {
            // code for reading from tony.txt
            $filename = 'toni.txt';
            $file = fopen($filename, "r") or die("Unable to open file!");//or die statement for errors.
            $data_assoc = array();
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
            // now, take the created associative array and use the contents to display all the chosen items.
            foreach($data_assoc as $key => $value) 
            {
                echo
                "<tr>" .
                "<td> <img src='$key' height =100 widt=100> </td>" .
                "<td> Price: $$value</td>" .
                "</tr>";
            }

            // close file now.
            fclose($file);
            // link to go back to store.
            echo "<a href='store.php'>Back to store?</a>";

        }
        else if (isset($_COOKIE["admin_"]))
        {
            // code for reading from admin.txt
            // code for reading from tony.txt
            $filename = 'admin.txt';
            $file = fopen($filename, "r") or die("Unable to open file!");//or die statement for errors.
            $data_assoc = array();
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
            // now, take the created associative array and use the contents to display all the chosen items.
            foreach($data_assoc as $key => $value) 
            {
                echo
                "<tr>" .
                "<td> <img src='$key' height =100 widt=100> </td>" .
                "<td> Price: $$value</td>" .
                "</tr>";
            }

            // close file now.
            fclose($file);
            // link to go back to store.
            echo "<a href='store.php'>Back to store?</a>";
        }
        
    }
    else if (!isset($_POST['item']))
    {
        // if the user did not select any items in the store, send them back 
        // along with ?select. This is checked for at the beginning
        // of the login page.
        header("Location:store.php?select");
    }
    else// only go here if pressing "add to cart"
    {
        
        
        if (isset($_COOKIE["toni_"]))
        {
            // set the first item of cookie as user
            $user = $_COOKIE["toni_"][0];
            // welcome user
            echo "Welcome $user, here is your cart.<br>";

            $filename = 'toni.txt';
            $file = fopen($filename, "w") or die("Unable to open file!");//or die statement for errors.



            // array for displaying items
            $data_assoc = array();
            // first, take in selections from previous page
            $item = $_POST['item'];
            // then display them to the user much like the store page.
            // iterate over each item. the information is one line
            foreach ($item as $fruit)
            {
                // create an array that has both URL and price separated.
                $key_value = explode(" ", $fruit);
                // add key and value to $data_ky associative array.
                // key = URL, value = price
                $data_assoc[$key_value[0]] = $key_value[1];
                // write to file in the same loop.
                fwrite($file, $fruit);

            }

            // now, take the created associative array and use the contents to display all the chosen items.
            foreach($data_assoc as $key => $value) 
            {
                echo
                "<tr>" .
                "<td> <img src='$key' height =100 widt=100> </td>" .
                "<td> Price: $$value</td>" .
                "</tr>";
            }
            
            
            // close file now.
            fclose($file);
            // link to go back to store.
            echo "<a href='store.php'>Back to store?</a>";
        }
        else if (isset($_COOKIE["admin_"]))
        {
           // set the first item of cookie as user
           $user = $_COOKIE["admin_"][0];
           // welcome user
           echo "Welcome $user, here is your cart.<br>";

           $filename = 'admin.txt';
           $file = fopen($filename, "w") or die("Unable to open file!");//or die statement for errors.



           // array for displaying items
           $data_assoc = array();
           // first, take in selections from previous page
           $item = $_POST['item'];
           // then display them to the user much like the store page.
           // iterate over each item. the information is one line
           foreach ($item as $fruit)
           {
               // create an array that has both URL and price separated.
               $key_value = explode(" ", $fruit);
               // add key and value to $data_ky associative array.
               // key = URL, value = price
               $data_assoc[$key_value[0]] = $key_value[1];
               // write to file in the same loop.
               fwrite($file, $fruit);

           }

           // now, take the created associative array and use the contents to display all the chosen items.
           foreach($data_assoc as $key => $value) 
           {
               echo
               "<tr>" .
               "<td> <img src='$key' height =100 widt=100> </td>" .
               "<td> Price: $$value</td>" .
               "</tr>";
           }
           
           
           // close file now.
            fclose($file);
            echo "<a href='admin.php'>Back to admin page?</a><br>";
            echo "<a href='store.php'>Back to store?</a><br>";
        }
        
        
        // code that saves cart to file. 
        // if user = toni, save to toni txt file.
        // if user = admin, save to toni txt file.


    }

?>