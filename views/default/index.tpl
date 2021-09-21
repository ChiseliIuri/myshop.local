{*шаблон шлавной страницы*}

{foreach $rsProducts as $item name = products}
    <div style="float: left; padding: 0px 30px 40px 0px;">
        <a href="/product/{$item['id']}/">
            <img src="images/products/{$item['image']}" width="120" alt="{$item['name']}.img">
        </a><br/>
        <a href="/product/{$item['id']}/">{$item['name']}</a>
    </div>
{/foreach}

{if $smarty.foreach.products.iteration mod 3 == 0}
    <div style="clear:both;"></div>
{/if}
