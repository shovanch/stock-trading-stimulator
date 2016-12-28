<?php
    
    // configuration file
    require("../includes/config.php");
    
    // when users submits the form 
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // checks if symbol field is empty
        if (empty($_POST["symbol"]))
        {
            apologize("You must enter a stock symbol");
        }
        
        // checks if shares field is empty
        if (empty($_POST["shares"]))
        {
            apologize("You must enter number of shares to purchase");
        }
        
        // make sure the shares are in whole number
        if (!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Enter valid number of shares");
        }
        
        //checks if the symbols are in only alphabets
        if (!preg_match("/^[a-zA-Z -]+$/", $_POST["symbol"]))
        {
            apologize("Enter valid Symbol");
        }
        
        // lookup the stock symbol to get current price
        $stock_info = lookup($_POST["symbol"]);
        
        // if stock is invalid or lookup fails
        if (!$stock_info)
        {
            apologize("Enter valid stock symbol");
        }
        
        // calculate the purchase amount 
        $buy_price = $stock_info["price"] * $_POST["shares"];
        
        // gets cash from user table to check user has sufficient balance
        $balance = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        
        if ($buy_price > $balance[0]["cash"])
        {
            apologize("Insufficient Cash");
        }
        
        // else add the stock in portfolio table
        CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?, upper(?), ?) 
                                    ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $stock_info["symbol"], $_POST["shares"]);
                                    
        // update cash balance in user table
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $buy_price, $_SESSION["id"]);
        
        // insert the transaction into history table
        CS50::query("INSERT INTO history (user_hid, trans_type, symbol, shares, price) VALUES(?, 'BUY', upper(?), ?, ?)", $_SESSION["id"],
                       $_POST["symbol"], $_POST["shares"], $stock_info["price"]);
        
        //redirect to portfolio
        redirect("/");
    }
    
    // render the buy form
    render("buy_view.php", ["title" => "Buy"]);
    
    
    
    
    
    
    
?>