<div id="leftColumn">
    <div id="leftMenu">
        <div id="menuBorder">
{*            <div class="menuCaption">Menu:</div>*}
            {foreach $rsCategories as $item}
                <a href="/category/{$item['id']}/">{$item['name']}</a>
                <br/>
                {if isset($item['children'])}
                    {foreach $item['children'] as $itemChild}

                        <a href="/category/{$itemChild['id']}/">   {$itemChild['name']}</a>
                        <br/>
                    {/foreach}
                {/if}
            {/foreach}
        </div>
    </div>

    {*    {if isset($arUser)}*}
    {*        <div id="userBox">*}
    {*            <a href="/user/" id="userLink">{$arUser['displayName']}</a><br/>*}
    {*            <span style="text-decoration: underline; color: red; cursor: pointer;" onclick="logout();">Exit</span>*}
    {*        </div>*}
    {*    {else}*}
    {*        <div id="userBox" class="hideme">*}
    {*            <a href="#" id="userLink"></a><br/>*}
    {*            <a href="#" onclick="logout();">Exit</a>*}
    {*        </div>*}
    {*        {if !isset($hideLoginBox)}*}
    {*            <div id="loginBox">*}
    {*                <div class="menuCaption">Autorizare</div>*}
    {*                <input type="text" id="loginEmail" name="loginEmail" value="" placeholder="mail"/><br/>*}
    {*                <input type="password" id="loginPwd" name="loginPwd" value="" placeholder="pass"/><br/>*}
    {*                <input type="button" onclick="login();" value="Log in">*}
    {*            </div>*}
    {*            <div id="registerBox">*}
    {*                <div class="menuCaption showHidden" onclick="showRegisterBox()">*}
    {*                    Inregistrare*}
    {*                    *}{*                <input type="button" onclick="showRegisterBox()" value="Inregistrare">*}
    {*                    *}{*                <a href="#" onclick="showRegisterBox()">Inregistrare</a>*}
    {*                </div>*}
    {*                <div id="registerBoxHidden">*}
    {*                    email:<br/>*}
    {*                    <input type="text" id="email" name="email" value="" onchange="validateEmail();"/><br/>*}
    {*                    password:<br/>*}
    {*                    <input type="password" id="pwd1" name="pwd1" value="" onchange="validatePwd();"/><br/>*}
    {*                    repeat password:<br/>*}
    {*                    <input type="password" id="pwd2" name="pwd2" value="" onchange="validatePwdMatch();"/><br/>*}
    {*                    <input type="button" onclick="registerNewUser();" value="Inregistreazama!"/><br/>*}
    {*                </div>*}
    {*            </div>*}
    {*        {/if}*}
    {*    {/if}*}

    {*    <div class="menuCaption;">Корзина</div>*}
    {*    <a href="/cart/" title="Перейти в корзину">В Корзине:</a>*}
    {*    <span id="cartCntItems">*}
    {*        {if $cartCntItems > 0}{$cartCntItems}{else}Пусто{/if}*}
    {*    </span>*}
</div>