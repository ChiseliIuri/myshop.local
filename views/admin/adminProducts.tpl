<h2>Товар</h2>
<table border="1" cellspacing="1" cellpadding="1">

    <caption>Add Product</caption>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Description</th>
        <th>Save</th>
    </tr>
    <tr>
        <td><input type="edit" id="newItemName" value=""></td>
        <td><input type="edit" id="newItemPrice" value=""></td>
        <td><select id="newItemCatId">
                {foreach $rsCategories as $itemCat}
                    <option value="{$itemCat['id']}">{$itemCat['name']}
                {/foreach}
            </select></td>
        <td>
            <textarea id="newItemDesc"></textarea>
        </td>
        <td>
            <input type="button" value="Save" onclick="addProduct();">
        </td>
    </tr>
</table>

<table border="1" cellspacing="1" cellpadding="1">
    <caption>Edit</caption>
    <tr>
        <th>№</th>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Description</th>
        <th>Delete</th>
        <th>Picture</th>
        <th>Save</th>
    </tr>
    {foreach $rsProducts as $item name=products}
        <tr>
            <td>{$smarty.foreach.products.iteration}</td>
            <td>{$item['id']}</td>
            <td>
                <input type="edit" id="itemName_{$item['id']}" value="{$item['name']}">
            </td>
            <td>
                <input type="edit" id="itemPrice_{$item['id']}" value="{$item['price']}">
            </td>
            <td>
                <select id="itemCatId_{$item['id']}">
                    {foreach $rsCategories as $itemCat}
                        <option value="{$itemCat['id']}" {if $item['category_id'] == $itemCat['id']}selected="selected"{/if}>{$itemCat['name']}
                    {/foreach}
                </select>
            </td>
            <td>
                <textarea id="itemDesc_{$item['id']}">
                    {$item['description']}
                </textarea>
            </td>
            <td>
                <input type="checkbox" autocomplete="off" id="itemStatus_{$item['id']}" {if $item['status'] == 0} checked {/if}>
            </td>
            <td>
                {if $item['image']}
                    <img src="/images/products/{$item['image']}" width="100">
                {/if}
                <form action="/admin/upload/" method="post" enctype="multipart/form-data">
                    <input type="file" name="filename">
                    <input type="hidden" name="itemId" value="{$item['id']}">
                    <input type="submit" value="Upload">
                </form>
            </td>
            <td>
                <input type="button" value="Save" onclick="updateProduct('{$item['id']}');">
            </td>
        </tr>
    {/foreach}
</table>