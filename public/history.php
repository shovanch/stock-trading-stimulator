<?php
    // configuration
    require("../includes/config.php"); 
    
    // get the matching user row from history table
    $rows = CS50::query("SELECT * FROM history WHERE user_hid = ?", $_SESSION["id"]);
    
    // if there no row yet as no past transaction
    if (count($rows) == 0)
    {
        apologize("You have not done any transaction yet.");
    }
    
    // render history_view by passing the value from $transact array
    render("history_view.php", ["rows" => $rows, "title" => "Transaction History"]);
?>