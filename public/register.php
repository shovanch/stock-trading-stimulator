<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate password and username
        if (empty(($_POST["password"]) or ($_POST["confirmation"])))
        {
            apologize("You must enter your password twice.");
        }
        else if (($_POST["password"]) !== ($_POST["confirmation"]))
        {
            apologize("Password does not match. Try again.");
        }
        else if (empty($_POST["username"]))
        {
            apologize("You must provide a username.");
        }
        
        
        // add user into database
        $user = CS50::query("INSERT IGNORE INTO users (username, hash, cash) 
                            VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        
        // if insert fails due to previously taken username
        if ($user == false)
        {
            apologize("Username already taken.");
        }
                            
        // logging in user automatically
        $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        // store logged user ID in SESSION id
        $_SESSION["id"] = $id;
        
        // redirect user to portfolio
        redirect("/");
        
        
    }

?>