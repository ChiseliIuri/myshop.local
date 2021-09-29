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
        {foreach $rsProducts as $item}
            <tr>
                <td>{$item['id']}</td>
                <td>{$item['name']}</td>
                <td>not available</td>
                <td>{$item['price']}</td>
                <td>not available</td>
                <td>not available</td>
            </tr>
        {/foreach}
    </table>
{/if}

