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