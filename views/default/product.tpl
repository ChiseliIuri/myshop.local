<h1>{$cat['name']}</h1>
{if isset($product)}
    <div style="text-align: center;">
        <h2>{$product['name']}</h2>
        <img src="/images/products/{$product['image']}" alt="{$product['image']}"><br/>
        {$product['description']}<br/><br/>
        PRICE: <span style="color: red;">{$product['price']}</span> RUB
    </div>
{else}
    <h1 style="text-align: center; color: red;">Oops produsul sau categoria nu exista. Pentru a va intoarce pe pagina principala tastati:
        <a href="/">Home</a>
    </h1>
{/if}