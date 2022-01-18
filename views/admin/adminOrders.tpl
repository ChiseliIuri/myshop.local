<h2>Orders</h2>
{if !$rsOrders}
    No Orders
{else}
    <table cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>Action</th>
            <th>Order ID</th>
            <th width="110">Status</th>
            <th>Created Date</th>
            <th>Pay Date</th>
            <th>Additional info</th>
            <th>Date of order change</th>
        </tr>
        {foreach $rsOrders as $item name = orders}
            <tr style="border-bottom: solid 2px">
                <td>{$smarty.foreach.orders.iteration}</td>
                <td>
                    <a href="#" onclick="showProducts('{$item['id']}'); return false;">Show product</a>
                </td>
                <td>{$item['id']}</td>
                <td>
                    <input type="checkbox" autocomplete="off" id="itemStatus_{$item['id']}"
                           {if $item['status']}checked="checked"{/if}
                            onclick="updateOrderStatus('{$item['id']}');">Closed
                </td>
                <td>{$item['date_created']}</td>
                <td>
                    <input {if $item['date_payment']} value="{$item['date_payment']}" {else} placeholder="Enter Date" {/if}type="text" onfocus="(this.type='date')" id="datePayment_{$item['id']}">
                    <!-- <input type="date" id="datePayment_{$item['id']}" value="{$item['date_payment']}"> -->
                    <input type="button" value="Save" onclick="updateDatePayment('{$item['id']}')">
                </td>
                <td>{$item['comment']}</td>
                <td>{$item['date_modification']}</td>
            </tr>
            <tr class="hideme" id="purchaseForOrderId_{$item['id']}">
                <td colspan="8">
                    {if $item['children']}
                        <table border = "1" cellpadding="1" cellspacing="1" width="100%">
                            <tr>
                                <th>№</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            {foreach $item['children'] as $itemChild name = products}
                                <tr>
                                    <td>{$smarty.foreach.products.iteration}</td>
                                    <td>{$itemChild['id']}</td>
                                    <td><a href="/product/{$itemChild['id']}/">{$itemChild['name']}</a></td>
                                    <td>{$itemChild['price']}</td>
                                    <td>{$itemChild['amount']}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                </td>
            </tr>
        {/foreach}
    </table>
{/if}