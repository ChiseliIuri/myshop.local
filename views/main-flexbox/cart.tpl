{*Шаблон корзины*}
<div id="cart-main">
    <h1 style="border-bottom: solid 1px silver;">Корзина</h1>

    {if ! $rsProducts}
        Вкорзине пусто
    {else}
        <form action="/cart/order/" method="POST">
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
                        <td>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                                <a href="" class="plusMinusLink"
                                   onclick="plusMinusButtonAction({$item['id']}, false, {$itemsIds});return false;">
                                    <div id="minus"></div>
                                </a>

                                <input style="padding-top: 3px; width: 25px;" name="itemCnt_{{$item['id']}}"
                                       id="itemCnt_{$item['id']}" type="text" value=1
                                       onchange="conversionPrice({$item['id']}); calcGenSum({$itemsIds});"/>
                                <a href="" class="plusMinusLink"
                                   onclick="plusMinusButtonAction({$item['id']}, true, {$itemsIds});return false;">
                                    <div id="plus"></div>
                                </a>
                            </div>
                        </td>
                        <td><span id="itemPrice_{$item['id']}" value="{$item['price']}">
                        {$item['price']}
                    </span>
                        </td>
                        <td><span id="itemRealPrice_{$item['id']}">{$item['price']}</span></td>
                        <td>
                            <a style="cursor: pointer; color: red;" id="removeCart_{$item['id']}"
                               onclick="removeFromCart({$item['id']});">Remove</a>
                            <a style="cursor: pointer; color: green;" id="addCart_{$item['id']}" class="hideme"
                               onclick="addToCart({$item['id']});">Restore
                            </a>
                        </td>
                    </tr>
                {/foreach}
                <tr bgcolor="silver">
                    <td>
                        Итог
                    </td>
                    <td align="right" colspan="4">
                        <div id="genSum">
                            {$sum}
                        </div>
                    </td>
                    <td></td>
                </tr>
            </table>
            <input style="margin-top: 20px;" type="submit" value="Place Order">
        </form>
    {/if}
</div>
