# Yandex Metrika API

Для начала работы необходимо создать клиент и указать счетчики и OAUTH токен.

```php
use Manzadey\YandexMetrika\Client;

$client = new Client('metrics', 'token');
```

Пример запроса к API:

```php
$response = $client->get('/stat/v1/data/bytime', [
    'metrics' => 'ym:s:visits',
    'date1'   => 'today',
    'date2'   => 'today',
]);

// return \Manzadey\YandexMetrika\Response
```

Функции для работы с Response:
```php
public function getResponse() : ResponseInterface

public function toArray() : array

public function getBody() : string
```