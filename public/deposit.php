<?php
    // main configuration file
    require("../includes/config.php");
    
    // when user submits the form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if the cash field is empty
        if (empty($_POST["cash"]))
        {
            apologize("Enter Cash amount to be added.");
        }
        
        // make sure cash amount is in whole number only
        if (!preg_match("/^\d+$/", $_POST["cash"]))
        {
            apologize("Enter valid cash amount.");
        }
        
        // add the cash into user table
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["cash"], $_SESSION["id"]);
        
        // redirect to portfolio
        redirect("/");
    }
    
    // render the add cash form
    render("deposit_form.php", ["title" => "Add Cash"]);
    
?>