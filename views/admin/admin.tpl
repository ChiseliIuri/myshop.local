<div id="blockNewCategory">
    New Category:
    <input name="newCategoryName" id="newCategoryName" type="text" value=""><br/>
    Is subcategory for:
    <select name="generalCardId" id="">
        <option value="0" selected>Main Category
        {foreach $rsCategories as $item}
            <option value="{$item['id']}">{$item['name']}
        {/foreach}
    </select>
    <br/>
    <input type="button" onclick="newCategory();" value="Add new Category"/>
</div>