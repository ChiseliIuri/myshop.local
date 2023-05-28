<html>
<head>
    <title>{$head}</title>
    <link rel="stylesheet" href="/{$templateWebPath}/css/main.css?version={$rand}" type="text/css"/>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <script src="/js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="/js/main.js" type="text/javascript"></script>
</head>
<body>
<div id="header-background">
    <div class="container" id="header-elements">
        <div id="homeBtt">
            <h1><a href="/">MyShop☺</a></h1>
        </div>
        <div id="search-block">
                <input id="search" placeholder="Search..." type="text" onchange="searchIt();">
                <a id="search_btt_cont" href="#" onclick="searchIt();">
                    <div id="search_btt">
                    </div>
                </a>
        </div>
        <div id="reg-cart">
            {if isset($arUser)}
                <div id="userBox">
                    <a href="/user/" id="userLink">{$arUser['displayName']}</a><br/>
                    <span style="text-decoration: underline; color: red; cursor: pointer;"
                          onclick="logout();">Exit</span>
                </div>
            {else}
                <div id="userBox" class="hideme">
                    <a href="#" id="userLink"></a><br/>
                    <a href="#" onclick="logout();">Exit</a>
                </div>
                {if !isset($hideLoginBox)}
                    <div id="loginBox" class="loginBox">
                        <input type="text" id="loginEmail" name="loginEmail" value="" placeholder="   mail"/><br/>
                        <input type="password" id="loginPwd" name="loginPwd" value="" placeholder="   pass"/><br/>
                        <input type="button" onclick="login();" value="Log in">
                    </div>
                    <div id="registerBox" class="registerBox">
                        <div style="position:relative;">
                            <div class="menuCaption showHidden" onclick="showRegisterBox()">
                                Inregistrare
                            </div>
                        </div>
                        <div style="box-shadow: 0px 0px 20px #36474f; position: absolute; margin-top: 50px; margin-left: -65px; background-color: #36474f">
                            <div style="padding: 10px;" id="registerBoxHidden">
                                <div>
                                    email:<br/>
                                    <input type="text" id="email" name="email" value=""
                                           onchange="validateEmail();"/><br/>
                                </div>
                                <div>
                                    password:<br/>
                                    <input type="password" id="pwd1" name="pwd1" value=""
                                           onchange="validatePwd();"/><br/>
                                </div>
                                <div>
                                    repeat password:<br/>
                                    <input type="password" id="pwd2" name="pwd2" value=""
                                           onchange="validatePwdMatch();"/><br/>
                                </div>
                                <div>
                                    <input type="button" onclick="registerNewUser();" value="Inregistreazama!"/><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            {/if}

            <div id="cartContainer">
                <a id="cos" href="/cart/" title="Перейти в корзину"
                   style="text-decoration: underline; margin-right: 5px; width: 27px; padding-right: 5px; font-size: 16px;"></a>
                <span id="cartCntItems">
                    {if $cartCntItems > 0}{$cartCntItems}{else} 0{/if}
                </span>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div id="left-center">

        {include file='leftColumn.tpl'}

        <div id="centerColumnContainer">