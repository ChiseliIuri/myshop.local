{*
                    ======================
                    = THIS IS COSTILI!!! =
                    ======================
    For fix: set default directory path and domen in apache!!!
    Descriere: cand se inarca pagina cu categorii(category tpl). Ea se trage din index.php. Si respectiv se strica path-ul
    care e dat pentru apelarea din www. Pentru a evita acest lucru trebuie de setat in apach directoria www si domenul,
    ceea ce nu pot face pe pc de la lucru. Pentru a rula proiectul la lucru a fost creat acest header anume pentru
    category.tpl
*}

<html>
<head>
    <title>{$head}</title>
    <link rel="stylesheet" href="../{$templateWebPath}/css/main.css" type="text/css"/>

</head>

<body>
<div id="header">
    <h1>my shop- internet magazin</h1>
</div>

{include file='leftColumn.tpl'}

<div id="centerColumn">