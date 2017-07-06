# PHP RestCountries

> Get information about countries via a RESTful API

## System requirements
* **PHP >= 5.5**

## Installation
Using Composer
  * `composer require namnv609/php-rest-countries`

or you can include the following in your `composer.json`
  * `"namnv609/php-rest-countries": "^1.0.0"`

## Usage instructions

First, create new `RestCountries` instance to make configuring the library for use:

```PHP
use NNV\RestCountries;

$restCountries = new RestCountries;
```

Once the `RestCountries` instance has been registered. You may use it like so:

### [All](https://restcountries.eu/#api-endpoints-all)

```PHP
$restCountries->all();
```

### [Name](https://restcountries.eu/#api-endpoints-name)

> Search by country name. It can be the native name or partial name or full name

```PHP
$restCountries->byName("viet");

// or with full name
$restCountries->byName("vietnam", true);
```

### [Code(s)](https://restcountries.eu/#api-endpoints-code)

> Search by ISO 3166-1 2-letter or 3-letter country code(s)

```PHP
// Single country code
$restCountries->byCodes("vn");

// Multiple country codes
$restCountries->byCodes(["vn", "cn", "th"]);
```

### [Currency](https://restcountries.eu/#api-endpoints-currency)

> Search by ISO 4217 currency code

```PHP
$restCountries->byCurrency("vnd");
```

### [Language](https://restcountries.eu/#api-endpoints-language)

> Search by ISO 639-1 language code.

```PHP
$restCountries->byLanguage("vi");
```

### [Capital city](https://restcountries.eu/#api-endpoints-capital-city)

> Search by capital city

```PHP
$restCountries->byCapitalCity("hanoi");
```

### [Calling code](https://restcountries.eu/#api-endpoints-calling-code)

> Search by calling code

```PHP
$restCountries->byCallingCode("84");
```

### [Region](https://restcountries.eu/#api-endpoints-region)

> Search by region: Africa, Americas, Asia, Europe, Oceania

```PHP
$restCountries->byRegion("asia");
```

### [Regional bloc](https://restcountries.eu/#api-endpoints-regional-bloc)

> Search by regional bloc:
> * EU (European Union)
> * EFTA (European Free Trade Association)
> * CARICOM (Caribbean Community)
> * PA (Pacific Alliance)
> * AU (African Union)
> * USAN (Union of South American Nations)
> * EEU (Eurasian Economic Union)
> * AL (Arab League)
> * ASEAN (Association of Southeast Asian Nations)
> * CAIS (Central American Integration System)
> * CEFTA (Central European Free Trade Agreement)
> * NAFTA (North American Free Trade Agreement)
> * SAARC (South Asian Association for Regional Cooperation)

```PHP
$restCountries->byRegionalBloc("asean");
```

### Filter response

> You can filter the output of your request to include only the specified fields.

```PHP
// You can use `fields([])` with any available methods

$restCountries->fields(["name", "callingCodes", "capital"])->all();

$restCountries->fields(["name"])->byName("vietnam", true);

$restCountries->fields(["callingCodes"])->byRegionalBloc("asean");
```
