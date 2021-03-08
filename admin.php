<?php
    // check for non admin through cookies? too complicated
    echo "<p>Welcome, admin</p>";

    // open file, declare array.
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
     // close file. will reopen for writing
    fclose ($file);

    // checkbox very similar to store.
    // keys and values are also in "hidden"
    // check boxes are used to omit from writing to file. 
    echo 
    "<html>" .
        "<body>" .
            "<a href='login.php'>login </a><br>" .
            "<h1>Check a box to remove item</h1>" .
            "<form action='admin.php' method='POST'>" . 
                "<table>";

                    // loop to print out each item using data from text file
                    foreach($data_assoc as $key => $value) 
                    {
                        echo
                        "<tr>" .
                        "<td> <input type=hidden name=hidden[] value='$key $value'>" .// put the key and value in hidden
                        "<td> <input type=checkbox name='item[]' value='$key $value'><img src='$key' height =100 widt=100> </td>" .
                        "<td> Price: $$value</td>" .
                        "</tr>";
                    }
    echo
                "</table>" .
                "<input type=submit name='remove' value='remove'>" .
            "</form>" .
            "<h1>Add item to page</h1>" .
            "<form action='admin.php' method='POST'>
                <label for='link'>Image URL:</label><br>
                <input type='text' id='link' name='link'><br>
                <label for='price'>Price:</label><br>
                <input type='text' id='price' name='price'><br><br>
                <input type='submit' name='add' value='add item'>
            </form>" .
            "<a href='store.php'>Go back to store?</a>" .
        "</body>" .
    "</html>";

    // code to be run after clicking submit for removing
    if (isset($_POST['remove']))
    {
        if (!isset($_POST['item']))
        {
            // do not continue if there is nothing selected.
            echo "No items selected!<br>";
        }
        else// this code will only run if something is set to be removed.
        {
            // reopen file for writing
            $file = fopen($filename, "w") or die("Unable to open file!");//or die statement for errors.
            // loop through each form for the fruit name and new price
            // remember that fopen 'w' will erase whatever is in the current text file.
            foreach ($_POST['hidden'] as $entry)// $entry has the img link and price in one line. 
            {
             
                if (in_array($entry, $_POST['item']))
                {
                    continue;// if an item in hidden is checked, it should skip it.
                }
                else 
                {
                    // else write the fruit name and price to file with new line appended.
                    fwrite($file, "$entry");
                }
            }
            // close file after writing.
            fclose($file);
            // redirect admin to store to "refresh" the items.
            header("Location: store.php");
        }
          
    }

    // code that runs after hitting "ADD" button
    if (isset($_POST['add']))
    {
        $imgurl = $_POST['link'];
        $itemprice = $_POST['price'];

        if($itemprice == '' or $imgurl == '')
        {
            echo "Need both items to add to store!<br>";
        }
        else
        {
            // only add to data.txt if both fields have information.
            // open file for appending
            $file = fopen($filename, "a") or die("Unable to open file!");
            // append to file. start with new line
            fwrite($file, "$imgurl $itemprice");
            // close file after appending
            fclose($file);
            // redirect admin to store to "refresh" the items.
            header("Location: store.php");
        }
    }
?>