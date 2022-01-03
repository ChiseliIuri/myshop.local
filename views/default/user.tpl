{*Pagina utilizatorului*}

<h1>Your register data:</h1>
<table border="0">
    <tr>
        <td>Login (email)</td>
        <td>{$arUser['email']}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" id="newName" value="{$arUser['name']}"></td>
    </tr>
    <tr>
        <td>Telephone</td>
        <td><input type="text" id="newPhone" value="{$arUser['phone']}"></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><textarea id="newAddress">{$arUser['address']}</textarea></td>
    </tr>
    <tr>
        <td>New Password</td>
        <td><input type="password" id="newPwd1" value=""></td>
    </tr>
    <tr>
        <td>Repeat New Password</td>
        <td><input type="password" id="newPwd2" value=""></td>
    </tr>
    <tr>
        <td>Current password</td>
        <td><input type="password" id="curPwd" value=""></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="button" value="Save Changes" onclick="updateUserData();"></td>
    </tr>
</table>
<h2>Your Orders</h2>
{if !$rsUserOrders}
    No Orders
{else}
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>Action</th>
            <th>Order ID</th>
            <th>Status</th>
            <th>Creating Date</th>
            <th>Payment Date</th>
            <th>Additional information</th>
        </tr>
        {foreach $rsUserOrders as $item name = orders}
            <tr>
                <td>{$smarty.foreach.orders.iteration}</td>
                <td>
                    <a href="#" onclick="showProducts('{$item['id']}'); return false;">Show product of order</a>
                </td>
                <td>{$item['id']}</td>
                <td>
                    {if $item['status'] == 0}
                        Not paid
                    {else}
                        Paid
                    {/if}
                </td>
                <td>{$item['date_created']}</td>
                <td>{$item['date_payment']}&nbsp</td>
                <td>{$item['comment']}</td>
            </tr>
            <tr class="hideme" id="purchaseForOrderId_{$item['id']}">
                <td colspan="7">
                    {if $item['children']}
                        <table border="1" cellpadding="1" cellspacing="1" width="100%">
                            <tr>
                                <th>№</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            {foreach $item['children'] as $itemChild name=products}
                                <tr>
                                    <td>{$smarty.foreach.products.iteration}</td>
                                    <td>{$itemChild['product_id']}</td>
                                    <td>
                                        <a href="/product/{$itemChild['id']}/">{$itemChild['name']}</a>
                                    </td>
                                    <td>{$itemChild['price']}</td>
                                    <td>{$itemChild['amount']}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                </td>
            </tr>
        {/foreach}
        </tr></table>
{/if}