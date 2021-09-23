<h1>Товары Категории {$cat['name']}</h1>
    {foreach $rsProducts as $item name = products}
        <div style="float:left; padding: 0px 30px 40px 0px;">
            <a href="/myshop.local/www/index.php/?controller=category&id={$item['id']}">
                <img src="../images/products/{$item['image']}" width="100" alt="{$item['image']}">
            </a><br/>
            <a href="/myshop.local/www/index.php/?controller=category&id={$item['id']}">{$item['name']}</a>
        </div>
        {if $smarty.foreach.products.iteration mod 3 == 0}
            <div style="clear: both;"></div>
        {/if}
    {/foreach}

    {foreach $rsChildCats as $item name = childCats}
        <h2><a href="/myshop.local/www/index.php/?controller=category&id={$item['id']}">{$item['name']}</a></h2>
    {/foreach}

    {if $smarty.foreach.products.iteration == 0 && $smarty.foreach.childCats.iteration == 0}
        <h1 style="text-align: center; color: red;">Oops produsul sau categoria nu exista. Pentru a va intoarce pe pagina principala tastati:
            <a href="http://localhost/myshop.local/www/index.php">Home</a>
        </h1>
    {/if}