/**
 * Js funcitons for admin page
 */

/**
 *Ajax function for adding new category
 */
function newCategory(){
    let catName = document.getElementById('newCategoryName').value;
    let catID = document.getElementsByTagName('select')[0].value;
    console.log(catName + '__' + catID);
    let postData = 'newCategoryName=' + catName + '&generalCatId=' + catID;
    console.log(postData);

    $.ajax({
        type: 'POST',
        async: false,
        url:'/admin/addnewcat/',
        data: postData,
        dataType: 'json',
        success: function(data){
            if (data['success']){
                alert(data['message']);
                $('#newCategoryName').val('');
            } else {
                alert(data['message']);
            }
        }
    });
}

/**
 * Update category data
 *
 * @param catId
 */
function updateCat(catId){
    let name = document.getElementById("itemName_"+catId).value
    let parentId = document.getElementById("parentId_"+catId).value

    // \/old possibility of write post data(directly as if we would write in url)
    // let postData = 'itemId=' + catId + '&parentId=' + parentId + '&newName=' + name

    // \/new possibility of write post data(more beautifully and easier, as json)
    let postData = {itemId: catId, parentId: parentId, newName: name};

    $.ajax({
        type: 'POST',
        async: false,
        url: '/admin/updatecategory/',
        data: postData,
        dataType: 'json',
        success: function (data) {
                alert(data['message'])
        }
    });
}

/**
 * Add new product
 *
 */
function addProduct(){
    let postData = {
        itemName: $('#newItemName').val(),
        itemPrice: $('#newItemPrice').val(),
        itemCatId: $('#newItemCatId').val(),
        itemDesc: $('#newItemDesc').val()
    }

    $.ajax({
        type: 'POST',
        async: false,
        url: '/admin/addproduct/',
        data: postData,
        dataType: 'json',
        success: function (data) {
            alert(data['message'])
            if (data['success']) {
                $('#newItemName').val('')
                $('#newItemPrice').val('')
                $('#newItemCatId').val('')
                $('#newItemDesc').val('')
            }
        }
    })
}

/**
 * Update product Data
 *
 * @param itemId
 */
function updateProduct(itemId){
    let itemStatus = $('#itemStatus_' + itemId).val();
    console.log(itemStatus)
    if(!itemStatus){
        itemStatus = 1
    } else {
        itemStatus = 0
    }
    let postData = {
        itemId: itemId,
        itemName: $('#itemName_' + itemId).val(),
        itemPrice: $('#itemPrice_' + itemId).val(),
        itemCatId: $('#itemCatId_' + itemId).val(),
        itemDesc: $('#itemDesc_' + itemId).val(),
        itemStatus: itemStatus,
    }
    $.ajax({
        type: 'POST',
        async: false,
        url: '/admin/updateproduct/',
        data: postData,
        dataType: 'json',
        success: function (data) {
            console.log(data['message'])
            alert(data['message'])
        }
    })
}
