<?php
     // configuration
    require("../includes/config.php");
    
    // when user submits the form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    { 
        // if user submits without selecting any symbol
        if(empty($_POST["symbol"]))
        {
            apologize("You must select a stock to sell");
        }
        
        // queries for user_id and symbol, returns a table with those
        $stock_row = CS50::query("SELECT * FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]); 
        
        // lookup for current price 
        $current_price = lookup($stock_row[0]["symbol"]);
        
        // if lookup fails to get the stock price, else calculate total sell price
        if ($current_price != false)
        {
            $total = $stock_row[0]["shares"] * $current_price["price"];
        }
        
        // delete the specific stock from portfolio table
        CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $current_price["symbol"]);
            
        // update the cash amount in user table
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $total, $_SESSION["id"]);
        
        // insert the transaction into history table
        CS50::query("INSERT INTO history (user_hid, trans_type, symbol, shares, price) VALUES(?, 'SELL', ?, ?, ?)", $_SESSION["id"],
                       $stock_row[0]["symbol"], $stock_row[0]["shares"], $current_price["price"]);
    
        // redirect user to portfolio page
        redirect("/");
    }
    
    
    /*
        To insert the stocks in portfolio to sell_view dropdown option
    */ 
    
    // an empty associative array to store the symbol from portfolio table
    $stocks = [];
    
    // selects symbol from portfolio table
    $rows = CS50::query("SELECT symbol FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
    
    // if there is no shares in portfolio of that particular symbol
    if (count($rows) == 0)
    {
        apologize("You have no stock in portfolio");
    }
    
    // iterate over each row to get the symbols and store then in stocks[] array
    foreach ($rows as $row)
    {
        $stocks[] = [ "stocks" => $row["symbol"] ];
    }
    
    //render the sell form and pass the symbol data from stocks[] array
    render("sell_view.php", ["symbols" => $stocks, "title" => "Sell"]);
    
    
    
    
?>