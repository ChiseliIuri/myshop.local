{*Шаблон корзины*}

<h1>Корзина</h1>

{if ! $rsProducts}
    Вкорзине пусто
{else}
    <h2>Данные заказа</h2>
    <table>
        <tr>
            <td>№</td>
            <td>Наименование</td>
            <td>Количество</td>
            <td>Цена за единицу</td>
            <td>Цена</td>
            <td>Действие</td>
        </tr>
        {foreach $rsProducts as $item name = products}
            <tr>
                <td>{$smarty.foreach.products.iteration}</td>
                <td><a href="/product/{$item['id']}/">{$item['name']}</a></td>
                <td><input name="itemCnt_{{$item['id']}}" id="itemCnt_{$item['id']}" type="text" value=1
                           onchange="conversionPrice({$item['id']});"/>
                </td>
                <td><span id="itemPrice_{$item['id']}" value="{$item['price']}">
                        {$item['price']}
                    </span>
                </td>
                <td><span id="itemRealPrice_{$item['id']}">{$item['price']}</span></td>
                <td>
                    <button id="removeCart_{$item['id']}" onclick="removeFromCart({$item['id']})">Remove</button>
                    <button id="addCart_{$item['id']}" class="hideme" onclick="addToCart({$item['id']})">Restore</button>
                </td>
            </tr>
        {/foreach}
        <tr bgcolor="silver">
            <td>
                Итог
            </td>
            <td align="right" colspan="4">
                <div id="genSum">
                    сумма
                </div>
            </td>
            <td></td>
        </tr>
    </table>
{/if}

