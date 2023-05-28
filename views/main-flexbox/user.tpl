{*Pagina utilizatorului*}
<div id="user-container">
    <h2>Your register data:</h2>
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
    <div>
        <h2>Your Orders</h2>
        {if !$rsUserOrders}
            No Orders
        {else}
            {*    <input type="button" id="excelOrders" value="Get In Excel" onclick="getOrdersInExcel(); return false;">*}
            {*    <button id="excelOrders" formaction="/user/getexcel/" formmethod="get" >Get In Excel</button>*}
            <a href="/user/getexcel/">Get excel</a>
            <table cellpadding="1" cellspacing="1">
                <tr class="tr">
                    <th>№</th>
                    <th>Action</th>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Creating Date</th>
                    <th>Payment Date</th>
                    <th>Additional information</th>
                </tr>
                {foreach $rsUserOrders as $item name = orders}
                    <tr class="tr">
                        <td>{$smarty.foreach.orders.iteration}</td>
                        <td>
                            <a href="#" onclick="showProducts('{$item['id']}'); return false;">Show product of order</a>
                        </td>
                        <td>{$item['id']}</td>
                        <td>
                            {if $item['status'] == 0}
                                <span style="color: red;">Not paid</span>
                            {else}
                                <span style="color: green">Paid</span>
                            {/if}
                        </td>
                        <td>{$item['date_created']}</td>
                        <td>{$item['date_payment']}&nbsp</td>
                        <td>{$item['comment']}</td>
                    </tr>
                    <tr class="tr hideme product_table" id="purchaseForOrderId_{$item['id']}">
                        <td colspan="7">
                            {if $item['children']}
                                <table cellpadding="1" cellspacing="1" width="100%">
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
                                                <a href="/product/{$itemChild['product_id']}/">{$itemChild['name']}</a>
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
    </div>
</div>