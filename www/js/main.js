/**
 * Functia adaugarii elementului in cos
 *
 * @param integer itemID ID-ul produsului
 * @return in caz de success se reainoiesc datele despre produs pe pagina
 */
function addToCart(itemId){
    console.log("js - addtoCart()");
    $.ajax({
        type: 'POST',
        url: "/cart/addtocart/" + itemId + '/',
        dataType: 'json',
        success: function (data) {
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#addCart_' + itemId).hide();
                $('#removeCart_' + itemId).show();
            }
        }
    })
}