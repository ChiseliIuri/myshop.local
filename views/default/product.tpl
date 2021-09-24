<h1>{$cat['name']}</h1>
{if isset($product)}
    <div style="text-align: center;">
        <h2>{$product['name']}</h2>
        <img src="/images/products/{$product['image']}" alt="{$product['image']}"><br/>
        {$product['description']}<br/><br/>
        PRICE: <span style="color: red;">{$product['price']}</span> RUB<br/><br/><br/>
        <a href="#" alt="Добавить в корзину"
           id="addCart_{$product['id']}"
           onclick="addToCart({$product['id']}); return false;"
           style="border-radius: 20px;
           color:green ;
           text-decoration: none;
           background-color: silver;
           padding: 20px">
            Добавить в корзину
        </a>
        <a href="#" alt="Удалить из корзины"
           id="removeCart_{$product['id']}"
           onclick="removeFromCart({$product['id']}); return false;"
           style="border-radius: 20px;
           display: none;
           color:black ;
           text-decoration: none;
           background-color: red;
           padding: 20px">
            Удалить из корзины
        </a>
    </div>
{else}
    <h1 style="text-align: center; color: red;">Oops produsul sau categoria nu exista. Pentru a va intoarce pe pagina principala tastati:
        <a href="/">Home</a>
    </h1>
{/if}