<div id="leftColumn">
    <div id="leftMenu">
        <div class="menuCaption">Menu:</div>
        {foreach $rsCategories as $item}
            <a href="/myshop.local/www/index.php/?controller=category&id={$item['id']}">{$item['name']}</a><br/>
            {if isset($item['children'])}
                {foreach $item['children'] as $itemChild}
                    --<a href="/myshop.local/www/index.php/?controller=category&id={$itemChild['id']}">{$itemChild['name']}</a><br/>
                {/foreach}
            {/if}
        {/foreach}
    </div>
</div>