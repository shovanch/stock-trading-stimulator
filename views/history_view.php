<table class="table table-striped">
    <thead>
        <tr>
            <th>TRANSACTION</th>
            <th>DATE/TIME</th>
            <th>SYMBOL</th>
            <th>SHARES</th>
            <th>SHARE PRICE</th>
        </tr>
    </thead>
    
    <tbody>
    <?php
        
        foreach ($rows as $row)
        {
            print("<tr>");
            print("<td>{$row["trans_type"]}</td>");
            print("<td>{$row["datetime"]}</td>");
            print("<td>{$row["symbol"]}</td>");
            print("<td>{$row["shares"]}</td>");
            print("<td>\$" . number_format($row["price"], 2) . "</td>");
            print("</tr>");
            
        }

    ?>
    
    </tbody>
</table>    