<?php
    // main configuration file
    require("../includes/config.php");
    
    // when user submits the form by POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        // check if the input is blank
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a symbol.");
        }
        else
        {
            // queries Yahoo finace for the stock, false if not found 
            $stock = lookup($_POST["symbol"]);
            
            // validate stock query
            if (!$stock)
            {
                apologize("Enter a valid stock symbol.");
            }
            
            // render the get quote_view result with the data parsed from LOOKUP
            render("/quote_view.php", ["symbol" => $stock["symbol"], "price" => $stock["price"], "name" => $stock["name"], "title" => "Quote"]);
        }
    }
    
    // render the quote form
    render("quote_form.php", ["title" => "Get Quote"]);
?>