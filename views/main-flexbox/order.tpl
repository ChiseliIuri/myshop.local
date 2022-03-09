{*Pagina comenzii*}

<div id="order-container">
    <h2 style="border-bottom: solid 1px silver">Order Data</h2>
    <form action="/cart/saveorder/" id="frmOrder" method="POST">
        <table>
            <tr>
                <td>№</td>
                <td>Denumirea</td>
                <td>Cantitatea</td>
                <td>Pretul unitatii</td>
                <td>Costul</td>
            </tr>
            {foreach $rsProducts as $item name=products}
                <tr>
                    {*            modalitatea de a folosi indexul iteratiei:*}
                    <td>{$smarty.foreach.products.iteration}</td>
                    <td><a href="/product/{$item['id']}">{$item['name']}</a></td>
                    <td>
                <span id="itemCnt_{$item['id']}">
                    <input type="hidden" name="itemCnt_{$item['id']}" value="{$item['cnt']}">
                    {$item['cnt']}
                </span>
                    </td>
                    <td>
                <span id="itemPrice_{$item['id']}">
                    <input type="hidden" name="itemPrice_{$item['id']}" value="{$item['price']}">
                    {$item['price']}
                </span>
                    </td>
                    <td>
                <span id="itemRealPrice_{$item['id']}">
                    <input type="hidden" name="itemRealPrice_{$item['id']}" value="{$item['realPrice']}">
                    {$item['realPrice']}
                </span>
                    </td>
                </tr>
            {/foreach}
        </table>
        {if isset($arUser)}
            {$buttonClass = ""}
            <h2 style="margin-top: 30px; border-bottom: solid 1px silver">Datele clientului</h2>
            <div id="orderUserInfoBox" {$buttonClass}>
                {$name = $arUser['name']}
                {$phone = $arUser['phone']}
                {$address = $arUser['address']}
                <table>
                    <tr>
                        <td>Name*</td>
                        <td><input type="text" id="name" name="name" value="{$name}"></td>
                    </tr>
                    <tr>
                        <td>Phone*</td>
                        <td><input type="text" id="phone" name="phone" value="{$phone}"></td>
                    </tr>
                    <tr>
                        <td>Address*</td>
                        <td><textarea name="address" id="address">{$address}</textarea></td>
                    </tr>
                </table>
            </div>
        {else}
            <div id="loginBox">
                <div class="menuCaption">Log In</div>
                <table>
                    <tr>
                        <td>Login</td>
                        <td><input type="text" id="loginEmail" name="loginEmail" value=""></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" id="loginPwd" name="loginPwd" value=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" onclick="login()" value="Log In"></td>
                    </tr>
                </table>
            </div>
            <div id="registerBox">OR<br>
                <div class="menuCaption">Register new user:</div>
                Email:<br/>
                <input type="text" id="email" name="email" value=""><br/>
                Password:<br/>
                <input type="password" id="pwd1" name="pwd1" value=""><br/>
                Repeat password:<br/>
                <input type="password" id="pwd2" name="pwd2" value=""><br/>

                Name:<br><input type="text" id="name" name="name" value=""><br/>
                Phone:<br><input type="text" id="phone" name="phone" value=""><br/>
                Address*:<br/><textarea name="address" id="address"></textarea><br/>
                <input type="button" onclick="registerNewUser();" value="Registry"/>
            </div>
            {$buttonClass = 'class="hideme"'}
        {/if}
        <input {$buttonClass} type="button" id="btnSaveOrder" value="Finish Order" onclick="saveOrder();">
    </form>
</div>


