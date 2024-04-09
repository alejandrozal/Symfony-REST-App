# test-for-me
```
Curl requests are at the bottom.
```
# IN ENGLISH

## Build a Symfony REST application for calculating product prices and processing payments.

Two endpoints are required:
POST: for price calculation

http://127.0.0.1:80/calculate-price

JSON request body example:
```
{
    "product": 1,
    "taxNumber": "DE123456789",
    "couponCode": "D15"
}
```
POST: for making a purchase

http://127.0.0.1:80/purchase

JSON request body example:
```
{
    "product": 1,
    "taxNumber": "IT12345678900",
    "couponCode": "D15",
    "paymentProcessor": "paypal"
}
```

Upon successful request execution, return an HTTP response with status code 200.

For invalid input data or payment errors, return an HTTP response with status code 400 and a JSON object with errors.

## Products
It is assumed that products are stored in a database. For example, you can take three products:
- Iphone (100 euros)
- Headphones (20 euros)
- Case (10 euros)

## Coupons
If a coupon is available, the buyer can apply it to the purchase.

A coupon can be of two types:
- Fixed discount amount
- Percentage of purchase amount
We assume that coupons are created by the seller and stored somewhere (or hardcoded, at your discretion).

That is, there should not be a situation where a coupon code determines the discount and the buyer can use any coupon code.

For example, with coupons P10 (10% discount) and P100 (100% discount) available (in the database or hardcoded), the buyer should not be able to apply coupon P50 unless it is explicitly stored.

The coupon code does not necessarily have to conform to any specific format. You can choose it at your discretion.

## Tax Calculation
When purchasing a product, the recipient must pay tax based on the country's tax number:
- Germany - 19%
- Italy - 22%
- France - 20%
- Greece - 24%

As a result, for a buyer from Greece, the price of an iPhone is 124 euros (product price 100 euros + 24% tax).
If the buyer has a coupon for a 6% discount on the purchase, the price will be 116.56 euros (product price 100 euros - 6% discount + 24% tax).

Tax ID Format

DEXXXXXXXXX - for residents of Germany,

ITXXXXXXXXXXX - for residents of Italy,

GRXXXXXXXXX - for residents of Greece,

FRYYXXXXXXXXX - for residents of France

where: 
- the first two characters are the country code,
- X - any digit from 0 to 9,
- Y - any letter

Note that the length of the tax ID varies for different countries.
Tax ID formats may change, but this happens rarely (depending on legislation).

## Details
When completing the task, you need to:

- validate all fields (including the correctness of the tax number according to the format) in the request bodies using Symfony validator
- calculate the final purchase price including the coupon (if specified) and tax
- use PaypalPaymentProcessor::pay() or StripePaymentProcessor::processPayment() for payment processing
These classes are provided in this project and should be used exactly as they are. They accept price in different units (cents or dollars) in their payment methods.
    - OR copy them into your project. For simplicity, consider these two classes as part of two different third-party SDKs, and **you cannot modify these classes or any logic inside them.**
    - OR add systemeio/test-for-candidates as a dependency via Composer.
- provide examples of HTTP requests to the two endpoints: path and request body (for manual testing) in curl command format in README.md

CRUD for entities does not need to be implemented; we assume it "exists" and the data in the database is valid, i.e., checks in services that the coupon discount percentage is greater than 0, less than 1000, and similar checks are not necessary.

When writing the test, use git. After completion, send the repository link.

Consider the possibility of adding new PaymentProcessors.

If you feel that a certain part of the task requires too much time to complete, you can choose the simplest solution and indicate possible implementation options in a comment that you consider.

### It would be a plus to:

- use containerization for PHP, PostgreSQL/MySQL
- include PHPUnit tests
- ensure the code adheres to SOLID principles (without fanaticism)
- commit-by-commit implementation is welcome
- demonstrate the ability NOT to use approaches like onion-based/DDD/CQS/hexagonal architecture when completing the task: we value correctness and completeness much more in our task; such complex concepts are rather inappropriate in our task.
- We do not limit you in terms of completing the task, but we expect that in the test task, you will reveal the principles you adhere to in your work.

# IN RUSSIAN
## Написать Symfony REST приложение для расчета цены продукта и проведения оплаты

Необходимо написать 2 эндпоинта:
1. POST: для расчёта цены
   
http://127.0.0.1:80/calculate-price

Пример json тела запроса:
```
{
    "product": 1,
    "taxNumber": "DE123456789",
    "couponCode": "D15"
}
```
2. POST: для выполнения покупки
   
http://127.0.0.1:80/purchase

Пример json тела запроса:
```
{
    "product": 1,
    "taxNumber": "IT12345678900",
    "couponCode": "D15",
    "paymentProcessor": "paypal"
}
```

При успешном выполнении запроса вернуть HTTP ответ с кодом 200.

При неверных входных данных или ошибках оплаты вернуть HTTP ответ с кодом 400 и json объект с ошибками.

## Продукты
Предполагается, что продукты хранятся в БД, для примера можно взять 3 продукта:
- Iphone (100 евро)
- Наушники (20 евро)
- Чехол (10 евро)

## Купоны
При наличии купона покупатель может применить его к покупке.

Купон может быть двух типов:
- фиксированная сумма скидки
- процент от суммы покупки
  
Мы подразумеваем, что купоны создаются продавцом и где-то хранятся (ну или захардкодены, на ваше усмотрение)

т.е. не должно быть ситуации, когда код купона определяет скидку и покупатель может подставить любой код купона.

Например, при наличии (в БД или в виде хардкода) купонов P10 (скидка 10%) и P100 (скидка 100%) у покупателя не должно быть возможности применить купон P50, если он не хранится явным образом.

Код купона не обязательно должен соответствовать какому-либо формату. Вы можете выбрать его на своё усмотрение.


## Расчет налога
При покупке продукта получатель сверх цены продукта должен уплатить налог, относительно страны налогового номера:
- Германии - 19%
- Италии - 22%
- Франции - 20%
- Греции - 24%

В итоге для покупателя Iphone из Греции цена составляет 124 евро (цена продукта 100 евро + налог 24%).  
Если у покупателя есть купон на 6% скидку на покупку, то цена будет 116.56 евро (цена продукта 100 евро - 6% скидка + налог 24%).

## Формат налогового номера
DEXXXXXXXXX - для жителей Германии,

ITXXXXXXXXXXX - для жителей Италии,

GRXXXXXXXXX - для жителей Греции,

FRYYXXXXXXXXX - для жителей Франции

где: 
- первые два символа - это код страны,
- X - любая цифра от 0 до 9,
- Y - любая буква

Обратите внимание, что длина налогового номера разная для разных стран.  
Форматы налоговых номеров могут меняться, что случается редко. (Это зависит от законодательства.)

## Детали
При выполнении задания нужно:
- реализовать валидацию всех полей (в том числе корректность tax номера согласно формату) в теле запросов, используя Symfony validator
- рассчитать итоговую цену покупки вместе с купоном (если указан) и налогом
- использовать для проведения платежа `PaypalPaymentProcessor::pay()` или `StripePaymentProcessor::processPayment()`  
Эти классы представлены в этом проекте, использовать следует именно их. В методах оплаты они принимают цену как в разных юнитах (как в центах, так и в долларах).
    - ИЛИ скопируйте их себе в проект. Для простоты представьте, что эти два класса входят в два разных сторонних SDK, и у вас **нет возможности править эти классы или какую-либо логику внутри них**.
    - ИЛИ добавьте `systemeio/test-for-candidates` как зависимость через Composer.
- приложить в README.md примеры HTTP-запросов к двум эндпоинтам: path и тело запроса (для ручного тестирования) в формате curl команды

CRUD для сущностей писать не нужно, будем считать что он "есть" и данные в БД валидны, т.е. проверок в сервисах, что процентная скидка по купону больше 0, меньше 1000 и прочих подобных делать не нужно.

При написании тестового используйте git, после выполнения пришлите ссылку на репозиторий.

Необходимо учесть возможность добавления новых PaymentProcessors.

Если вы чувствуете, что определённая часть задания требует у вас много времени на выполнение, вы можете выбрать наиболее простое решение и комментарием указать возможные варианты реализации, которые вы рассматриваете

### Будет плюсом
- использование контейнеризации для php, postgres/mysql
- наличие PHPUnit tests
- соответствие кода принципам SOLID (без фанатизма)
- покоммитное оформление этапов реализации приветствуется
- продемонстрированное умение **НЕ!** использовать подходы вроде onion-based/DDD/CQS/гексагональной архитектуры при выполнении задания: мы куда больше ценим его корректность и полноту; такие сложные концепции в нашем задании скорее не уместны

Мы не ограничиваем вас по срокам выполнения задания, но при этом ожидаем, что в тестовом задании вы раскроете принципы, которых придерживаетесь в работе. 

# Dockerization

docker-compose up -d --force-recreate

# Curl Requests

1. 

1.1) 
```
curl --location 'http://127.0.0.1:8000/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
    "product": 1,
    "taxNumber": "DE123456789",
    "couponCode": "D15"
}'
```

## Response
```
{
    "data": {
        "price": 119
    },
    "message": "Total price is 119"
}
```

1.2) 
```
curl --location 'http://127.0.0.1:8000/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
    "product": 2,
    "taxNumber": "DE123456789",
    "couponCode": "D10"
}'
```
## Response
```
{
    "message": "Object(App\\Entity\\Coupons\\DeCoupon10).code:\n    This value should not be blank. (code c1051bb4-d103-4f74-8988-acbcafc7fdc3)\n",
    "data": {}
}
```
2. 
```
curl --location 'http://127.0.0.1:8000/purchase' \
--header 'Content-Type: application/json' \
--data '{
    "product": 1,
    "taxNumber": "IT12345678900",
    "couponCode": "D15",
    "paymentProcessor": "paypal"
}'
```

## Response
```
{
    "data": "Must be the processing logic here",
    "message": "Here's the purchase result."
}
```