/**
 * Functia adaugarii elementului in cos
 *
 * @param integer itemID ID-ul produsului
 * @return in caz de success se reainoiesc datele despre produs pe pagina
 */
function addToCart(itemId) {
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
                document.getElementById('itemCnt_'+itemId).value = 1;
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
    console.log(itemId);
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
                document.getElementById('itemCnt_'+itemId).value = 0;
            }
        }
    })
}

/**
 * Functie de calculare a pretului real
 *
 * @param itemId id productului
 */
function conversionPrice(itemId) {
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;

    $('#itemRealPrice_' + itemId).html(itemRealPrice);
}

/**
 * Calcularea sumei in dependenta de cantitatea alesa a unui produs
 *
 * @param itemsIds id tuturor productelor
 */
function calcGenSum(itemsIds) {
    let sum = 0;
    itemsIds.forEach((element) => {
        sum = sum + parseInt(document.getElementById('itemRealPrice_' + element).textContent)
    })
    document.getElementById('genSum').innerHTML = sum
}

/**
 * Citirea datelor de inregistrare din forma
 *
 */
function getData(obj_form) {
    var hData = {};
    $('input, textarea, select', obj_form).each(function () {
        if (this.name && this.name != '') {
            hData[this.name] = this.value;
        }
    })
    return hData
}

/**
 * Inregistrarea unui nou utilizator
 *
 */

function registerNewUser() {
    var postData = getData('#registerBox');

    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/register/",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data['success']) {
                alert('Successfully Registered')

                //>bloc in coloana din stanga
                $('#registerBox').hide();
                $('#userLink').attr('href', '/user/')
                $('#userLink').html(data['userName'])
                $('#userBox').show()

                //>pagina comenzii
                $('#loginBox').hide()
                // $('#btnSaveOrder').show()
                document.getElementById('btnSaveOrder').style.display='block';

            } else {
                alert(data['message'])
            }
        }
    })
}

/**
 * Update dates of user
 *
 *
 */
function updateUserData(){
    console.log("js - updateUserdata()");
    let phone = $('#newPhone').val();
    let address = $('#newAddress').val();
    let pwd1 = $('#newPwd1').val();
    let pwd2 = $('#newPwd2').val();
    let curPwd = $('#curPwd').val();
    let name = $('#newName').val();

    let postData = {
        phone: phone,
        address: address,
        pwd1: pwd1,
        pwd2: pwd2,
        curPwd: curPwd,
        name: name
    };
    console.log(postData)

    $.ajax({
        type: 'POST',
        async: false,
        url: '/user/update/',
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data['success']){
                $('#userLink').html(data['userName'])
                alert(data['message'])
            } else {
                alert(data['message'])
            }
        }
    })
}

/**
 * Delogarea utilizatorului
 *
 */
function logout() {
    $.ajax({
        type: 'GET',
        async: false,
        url: "/user/logout/",
        success: function () {
            window.location.replace("/")
        }
    })
}

/**
 * Logarea utilizatorului
 *
 */
function login() {
    let email = $('#loginEmail').val();
    let pwd = document.getElementById('loginPwd').value

    var postData = 'email=' + email + '&pwd=' + pwd;

    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/login/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#registerBox').hide()
                $('#loginBox').hide()

                $('#userLink').attr('href', '/user/')
                $('#userLink').html(data['displayName'])
                $('#userBox').show()
                document.getElementById('name').value = data['name'];
                document.getElementById('phone').value = data['phone'];
                document.getElementById('address').value = data['address'];
                document.getElementById('btnSaveOrder').style.display='block';
            } else{
                alert(data['message']);
            }
        }
    })
}

/**
 * Prevalidarea emailului introdus
 *
 */
function validateEmail() {
    let response = {message: ""};
    let value = document.getElementById('email').value;
    if (/[A-z0-9-_.]{3,}@[A-z]{2,}\.[A-z]{2,}/.test(value)) {
        document.getElementById('email').style.borderColor = 'green';
    } else {
        response['message'] += "Emailul introdus trebuie sa corespunda formatului! (sample@mail.com) \n"
        alert(response["message"])
        document.getElementById('email').style.borderColor = 'red';
    }
}

/**
 * Prevalidarea parolei introduse
 *
 */
function validatePwd() {
    let response = {message: ""};
    let value = document.getElementById('pwd1').value;
    if (/[A-z0-9-_(){}\[\]/]{8,}/g.test(value)) {
        document.getElementById('pwd1').style.borderColor = 'green';
    } else {
        response["message"] += "Parola trebuie sa contina minim 8 caractere admisibile(A-z 0-9 -_ () {} [] / ) \n"
        alert(response["message"])
        document.getElementById('pwd1').style.borderColor = 'red';
    }

    if (document.getElementById('email').value == "") {
        alert("Nu ati introdus email!!!")
        document.getElementById('email').style.borderColor = 'red';
    }
}

/**
 * Controlarea coincidentei parolelor
 *
 */
function validatePwdMatch() {
    let response = {message: ""};
    console.log(document.getElementById('pwd1').value)
    let pwd1 = document.getElementById('pwd1').value
    let pwd2 = document.getElementById('pwd2').value
    let email = document.getElementById('email').value
    if (pwd1 != pwd2) {
        response['message'] += "Parolele nu coincid!";
        alert(response['message']);
        document.getElementById('pwd1').style.borderColor = 'red';
        document.getElementById('pwd2').style.borderColor = 'red';
    } else {
        document.getElementById('pwd2').style.borderColor = 'green';
    }
    if (email == "") {
        alert("Nu ati introdus email!!!")
        document.getElementById('email').style.borderColor = 'red';
    }
    if (pwd1 == "") {
        alert("Nu ati introdus prima parola!!!")
        document.getElementById('pwd1').style.borderColor = 'red'
    }
    if (pwd1 == "" && email == "") {
        alert("Nu ati introdus emailul si prima parola!!!")
        document.getElementById('email').style.borderColor = 'red'
        document.getElementById('pwd1').style.borderColor = 'red'
    }
}

/**
 * Functia ce vizualizeaza campul de inregistrare
 *
 */

//Varianta mea, fara jquery(aici trebuie de lucrat fara stil in css file, dar de declarat display in style attr)
// function showRegisterBox(){
//     if(document.getElementById('registerBoxHidden').style.display == 'none') {
//         document.getElementById('registerBoxHidden').style.display = 'block';
//     } else {
//         document.getElementById('registerBoxHidden').style.display = 'none'
//     }
// }

//varianta lu prof cu jquery, aici spoate de lucrat cu css file
// function showRegisterBox(){
//     if ($("#registerBoxHidden").css('display') != 'block'){
//         $("#registerBoxHidden").show()
//     } else {
//         $("#registerBoxHidden").hide()
//     }
// }

//Varianta din comenturi
function showRegisterBox(){
    $("#registerBoxHidden").toggle()
}

/**
 * Salvarea comenzii
 *
 */
function saveOrder(){
    var postData = getData('form')
    $.ajax({
        type: 'POST',
        async: false,
        url: "/cart/saveorder/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if (data['success']){
                alert(data['message'])
                document.location = '/';
            } else {
                alert(data['message']);
            }
        }
    })
}

/**
 * Show product under-table in orders table
 *
 * @param item
 */
function showProducts(item){
    // document.getElementById('purchaseForOrderId_'+item).style.display = 'block';
    $("#purchaseForOrderId_" + item).toggle()
}

/**
 * Add or delete product item in cart
 *
 * @param flag if false then minus, if true then plus
 * @param itemId
 * @param itemsIds array with ids of all products
 */
function plusMinusButtonAction(itemId, flag, itemsIds){
    let initialValue = parseInt(document.getElementById('itemCnt_' + itemId).value);
    console.log(initialValue);
    if (flag){
        if (initialValue < 99 && initialValue !== 0 ){
            document.getElementById('itemCnt_' + itemId).value = initialValue + 1;
            conversionPrice(itemId);
            calcGenSum(itemsIds);
        } else if(initialValue == 0){
            addToCart(itemId);
        } else {
            document.getElementById('itemCnt_' + itemId).value = 99;
            conversionPrice(itemId);
            calcGenSum(itemsIds);
        }
    } else {
        if (initialValue == 1){
            removeFromCart(itemId);
        } else {
            document.getElementById('itemCnt_' + itemId).value = initialValue - 1;
            conversionPrice(itemId);
            calcGenSum(itemsIds);
        }
    }
}

/**
 * Search of product by string
 *
 */
function searchIt(){
    let $searchingString = document.getElementById('search').value;
    let getData = 'string='+$searchingString;
    if (getData){
        window.location='/product/search/?'+getData;
    }
}








