# NFe

Site bem básico desenvolvido com Laravel para consulta de NFe a partir da **chave de acesso**.

# API 1.0 [CAPTCHA]

Fornecido pelo site oficial do [DANFE](https://danfe.br.com/desenvolvedores/).

### Procedimento

[Obtenha](https://danfe.br.com/desenvolvedores/) a API_KEY.

Dentro de `app/Http/Controllers/Site`, criar o arquivo `vars.php`, que ficará da seguinte forma:

```php
<?php

namespace App\Http\Controllers\Site;
$chaveAcesso = 'SUA_CHAVE_AQUI'; // Chave de acesso da NFe que está tentando obter, para testes
$API_KEY = 'SUA_API_KEY';
```

### SiteController

A função `getCaptcha()` recebe a chave da NFe como argumento, a função receberá uma `KEY` através da requisição que é responsável pela recuperação do captcha.

Tendo agora `API_KEY`, `KEY` e `CHAVE_DE_ACESSO`, solicitamos a imagem do captcha, que é renderizada para o usuário em `templete.blade.php`.

Se o captcha estiver correto é possível visualizar o arquivo XML no console.

