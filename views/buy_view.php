<form action= "buy.php" method= "post">
    <fieldset>
        <div class= "form-group">
            <input autocomplete="off" autofocus class="form-control" name="symbol" placeholder="Stock Symbol" type="text"/>
        </div>
            
        <div class= "form-group">
            <input autocomplete="off"  class="form-control" name="shares" placeholder="Shares" type="text"/>
        </div>
        
        <div class= "form-group">
            <button class="btn btn-default" type="submit">
                Buy
            </button>
        </div>
    </fieldset>
</form>
<div><a href="http://www.nasdaq.com/screening/companies-by-industry.aspx?industry=Technology&sortname=marketcap&sorttype=1" target="_blank">Get Companies Stock Symbol from here</a></div>