<?php

    // configuration
    require("../includes/config.php"); 
    
    // make positions associative array
    $positions = [];
    
    // select the user from the table
    $rows =CS50::query("SELECT symbol, shares FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
    
    // iterate over rows and populate the postitions array
    foreach ($rows as $row)
    {
        // lookup the stock for current info
        $stock = lookup($row["symbol"]);
        
        // check if stock is invalid, else parse the lookup data into positions[]
        if($stock !== false)
        {
            $positions[] = 
            [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total_price" => $row["shares"] * $stock["price"]
            ];
        }
    }
    
    // select user from  users table to get CASH
    $dows = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    
    // render portfolio by passing on the values
    render("portfolio.php", ["positions" => $positions,"cash" => $dows[0]["cash"] ,"title" => "Portfolio"]);

?>
