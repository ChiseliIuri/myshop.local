/**
 * Functia adaugarii elementului in cos
 *
 * @param integer itemID ID-ul produsului
 * @return in caz de success se reainoiesc datele despre produs pe pagina
 */
function addToCart(itemId) {
    console.log("js - addtoCart()");
    $.ajax({
        type: 'POST',
        // async: false,
        url: "/cart/addtocart/" + itemId + '/',
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                $('#cartCntItems').html(data['cntItems']);
                $('#addCart_' + itemId).hide();
                $('#removeCart_' + itemId).show();
            }
        }
    })
}

/**
 * Functia stergerii elementului din cos
 *
 * @param itemId
 * @return in caz de success se reainoiesc datele despre produs pe pagina
 */
function removeFromCart(itemId) {
    console.log("js - removefromCart(" + itemId + ")");
    $.ajax({
        type: 'POST',
        // async: false,
        url: "/cart/removefromcart/" + itemId + '/',
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                $('#cartCntItems').html(data['cntItems']);
                $('#addCart_' + itemId).show();
                $('#removeCart_' + itemId).hide();
            }
        }
    })
}

/**
 * Functie de calculare a pretului real
 *
 * @param itemId id productului
 */
function conversionPrice(itemId){
    var newCnt = $('#itemCnt_'+ itemId).val();
    var itemPrice = $('#itemPrice_'+ itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;

    $('#itemRealPrice_'+itemId).html(itemRealPrice);
}