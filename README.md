Projeto feito usando [Laravel 9](https://laravel.com/docs/9.x#meet-laravel), [MySQL](https://www.mysql.com/) e uma API disponibilizada pela [Binance](https://www.binance.com/) - https://binance-docs.github.io/apidocs/#symbol-price-ticker

---

### Arquivos principais:

    app/Console/Commands/AvgBigPrice.php
    app/Console/Commands/BidPrice.php

---

### Instalar
    
- `git clone https://github.com/odgiedev/crypto-profit.git` ou clique em `Code` e `Download ZIP`.

- Entre na pasta e renomeie o arquivo `.env.example` para `.env` | Atualize as variaveis de ambiente `DB_DATABASE=nome do seu banco de dados`, `DB_USERNAME=usuario do banco`, `DB_PASSWORD=senha do banco`.

- `composer install`

- `php artisan key:generate`

---

### Rodar
    
    php artisan c:saveBidPriceOnDataBase simbolo_da_criptomoeda
>Salva o preço da criptomoeda informada no banco de dados.
    
    php artisan c:checkAvgBigPrice simbolo_da_criptomoeda
>Informa se o preço da criptomoeda esta menor do que o preço medio dela.
