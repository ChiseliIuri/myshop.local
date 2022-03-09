<div id="catConteiner">
    <div style="border-bottom: solid 1px silver; margin-bottom: 50px">
        <h3>Товары Категории {$cat['name']}</h3>
    </div>
    <div>
        {foreach $rsProducts as $item name = products}
            <div style="float:left; padding: 0px 30px 40px 0px;">
                <a href="/product/{$item['id']}/">
                    <img src="/images/products/{$item['image']}" width="240px" alt="{$item['image']}">
                </a><br/>
                <a href="/product/{$item['id']}/">{$item['name']}</a>
            </div>
            {if $smarty.foreach.products.iteration mod 3 == 0}
                <div style="clear: both;"></div>
            {/if}
        {/foreach}

        {foreach $rsChildCats as $item name = childCats}
            <h2><a href="/category/{$item['id']}/">{$item['name']}</a></h2>
        {/foreach}

        {if $smarty.foreach.products.iteration == 0 && $smarty.foreach.childCats.iteration == 0}
            <h2 style="text-align: center; color: red;">Oops produsul sau categoria nu exista. Pentru a va intoarce pe pagina principala tastati:
                <a href="/">Home</a>
            </h2>
        {/if}
    </div>
</div>

