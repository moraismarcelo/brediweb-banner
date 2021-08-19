1 - no arquivo composer.json do Laravel, coloque:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://gitlab.com/pacotes-bredi/bredi-banner"
    }
]
```

2 - na linha de comando digite
`composer require bredi/banner`

se o git exigir, coloque seu login e senha do gitlab para poder baixar o pacote.

3 - na linha de comando: `php artisan migrate`

4 - rode o seeder para criar as transações: `php artisan db:seed --class=Bredi\\BrediBanner\\Database\\Seeders\\BannersTableSeeder`

O pacote vem com algumas funções para facilitar

1 - Recuperando os banners ativos
no seu controller:

```
//Apenas esta linha já retorna os registros
$banners = (new \Bredi\BrediBanner\Repository\BannerRepository)->getBannersAtivos();
```

exportando arquivo config do pacote BrediBanner:
`php artisan vendor:publish --tag=banner-config`

exportando as views do pacote BrediBanner:
`php artisan vendor:publish --tag=bredi-banner`

# API

Recuperar banners ativos por api

`GET => /api/banner-list`