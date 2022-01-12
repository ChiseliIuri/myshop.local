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
                <option value="0">Main Category
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