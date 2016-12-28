<table class="table table-striped">
    <thead>
        <tr>
            <th>SYMBOL</th>
            <th>NAME</th>
            <th>SHARES</th>
            <th>PRICE</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    
    <tbody>
    <?php
        
        foreach ($positions as $position)
        {
            print("<tr>");
            print("<td>{$position["symbol"]}</td>");
            print("<td>{$position["name"]}</td>");
            print("<td>{$position["shares"]}</td>");
            print("<td>\${$position["price"]}</td>");
            print("<td>\$" . number_format($position["total_price"], 2) . "</td>");
            print("</tr>");
            
        }

    ?>
    <tr>
        <td colspan="4">CASH</td>
        <td>$<?= number_format($cash,2)?></td>
    </tr>
    </tbody>
</table>    

