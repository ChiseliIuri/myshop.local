{*шаблон страницы поиска*}
<div>
    <div style="display: block; border-bottom: 1px solid silver;">
        <h1>{$findPageTitle}</h1>
    </div>
    <div id="findItemsBox" style="display: flex; flex-wrap: wrap;">
        {if $rsFoundProducts}
            {foreach $rsFoundProducts as $item name = products}
                <div class="product-card">
                    <a href="/product/{$item['id']}/">
                        <img src="/images/products/{$item['image']}" width="240" alt="{$item['name']}.img">
                    </a><br/>
                    <a href="/product/{$item['id']}/">{$item['name']}</a>
                </div>
            {/foreach}
        {else}
            <h2 style="color: silver">Product not found</h2>
        {/if}
    </div>
</div>

