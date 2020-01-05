# Yahoo Finance non oficial SDK
<p align="center">
<a href="https://packagist.org/packages/floda/yahoo_finance"><img src="https://poser.pugx.org/floda/yahoo_finance/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/floda/yahoo_finance"><img src="https://poser.pugx.org/floda/yahoo_finance/license" alt="License"></a>
</p>

Since APIs have been discontinued in November 2017, this client is using non-official API endpoints for quotes, search and historical data.

**WARNING:** These non-official APIs cannot be assumed stable and might break any time. Also, you might violate Yahoo's terms of service. So use them at your own risk.


# Installation

```shell
$ composer require "floda/yahoo_finance"
```
<br>

# Usage

If your project has not an autoloder, just include once this line:
```php
require_once __DIR__ . "/../vendor/autoload.php";
```

For Laravel 5, Symfony, just instance object and use functions 

<br>

## Historical Data

```php
<?php

// Instance Object
$yf = new \floda\yahoo_finance\YF();

//Params
$symbol ="TRAN.BA";       //tickers with no .XX, API will return US stock market ticker  
                          //for example: $symbol="AAPL";
                          // For another countries, you can use for example:
                          // .BA -> Argentina -> Buenos Aires Stock Exchange (BYMA)

$time_ago = "3 months";   //you can use xx days, xx weeks, xx months, xx years, etc

$historical = $yf->getHistorical($symbol, $time_ago);
/*
Array
(
  [0] => Array
      (
          [date] => 2019-10-04
          [open] => 21.950001
          [high] => 22.9
          [low] => 21.950001
          [close] => 22.9
          [adjClose] => 22.9
          [volume] => 277948
      )

  ....
  ....

  [59] => Array
      (
          [date] => 2020-01-03
          [open] => 25.5
          [high] => 25.549999
          [low] => 24.5
          [close] => 24.950001
          [adjClose] => 24.950001
          [volume] => 229283
      )
)
*/

```

<br>

## All Exchanges

|<sub>Sufix</sub>|<sub>Country</sub>|<sub>City</sub>|<sub>Sufix</sub>|<sub>Country</sub>|<sub>City</sub>|
| :------------- | :------------- | :------------- | :------------- | :------------- | :------------- |
|<sub>.BA</sub>|<sub>Argentina</sub>|<sub>Buenos Aires (BYMA)</sub>|<sub>.NS</sub>|<sub>India</sub>|<sub>National of India</sub>|
|<sub>.VI</sub>|<sub>Austria</sub>|<sub>Vienna</sub>|<sub>.JK</sub>|<sub>Indonesia</sub>|<sub>Indonesia (IDX)</sub>|
|<sub>.AX</sub>|<sub>Australia</sub>|<sub>Australian (ASX)</sub>|<sub>.IR</sub>|<sub>Ireland</sub>|<sub>Euronext Dublin</sub>|
|<sub>.BR</sub>|<sub>Belgium</sub>|<sub>Euronext Brussels</sub>|<sub>.TA</sub>|<sub>Israel</sub>|<sub>Tel Aviv</sub>|
|<sub>.SA</sub>|<sub>Brazil</sub>|<sub>Sao Paolo (BOVESPA)</sub>|<sub>.TI</sub>|<sub>Italy</sub>|<sub>EuroTLX</sub>|
|<sub>.CN</sub>|<sub>Canada</sub>|<sub>Canadian Securities</sub>|<sub>.MI</sub>|<sub>Italy</sub>|<sub>Italian</sub>|
|<sub>.NE</sub>|<sub>Canada</sub>|<sub>NEO Exchange</sub>|<sub>.T</sub>|<sub>Japan</sub>|<sub>Tokyo</sub>|
|<sub>.TO</sub>|<sub>Canada</sub>|<sub>Toronto (TSX)</sub>|<sub>.RG</sub>|<sub>Latvia</sub>|<sub>Nasdaq OMX Riga</sub>|
|<sub>.V</sub>|<sub>Canada</sub>|<sub>TSX Venture Exchange (TSXV)</sub>|<sub>.VS</sub>|<sub>Lithuania</sub>|<sub>Nasdaq OMX Vilnius</sub>|
|<sub>.SN</sub>|<sub>Chile</sub>|<sub>Santiago</sub>|<sub>.KL</sub>|<sub>Malaysia</sub>|<sub>Malaysian</sub>|
|<sub>.SS</sub>|<sub>China</sub>|<sub>Shanghai</sub>|<sub>.MX</sub>|<sub>Mexico</sub>|<sub>Mexico (BMV)</sub>|
|<sub>.SZ</sub>|<sub>China</sub>|<sub>Shenzhen</sub>|<sub>.AS</sub>|<sub>Netherlands</sub>|<sub>Euronext Amsterdam</sub>|
|<sub>.PR</sub>|<sub>Czech Republic</sub>|<sub>Prague Index</sub>|<sub>.NZ</sub>|<sub>New Zealand</sub>|<sub>New Zealand (NZX)</sub>|
|<sub>.CO</sub>|<sub>Denmark</sub>|<sub>Nasdaq OMX Copenhagen</sub>|<sub>.OL</sub>|<sub>Norway</sub>|<sub>Oslo</sub>|
|<sub>.CA</sub>|<sub>Egypt</sub>|<sub>Egyptian Index (EGID)</sub>|<sub>.LS</sub>|<sub>Portugal</sub>|<sub>Euronext Lisbon</sub>|
|<sub>.TL</sub>|<sub>Estonia</sub>|<sub>Nasdaq OMX Tallinn</sub>|<sub>.QA</sub>|<sub>Qatar</sub>|<sub>Qatar</sub>|
|<sub>.HE</sub>|<sub>Finland</sub>|<sub>Nasdaq OMX Helsinki</sub>|<sub>.ME</sub>|<sub>Russia</sub>|<sub>Moscow Exchange (MOEX)</sub>|
|<sub>.NX</sub>|<sub>France</sub>|<sub>Euronext</sub>|<sub>.SI</sub>|<sub>Singapore</sub>|<sub>Singapore (SGX)</sub>|
|<sub>.PA</sub>|<sub>France</sub>|<sub>Euronext Paris</sub>|<sub>.JO</sub>|<sub>South Africa</sub>|<sub>Johannesburg</sub>|
|<sub>.BE</sub>|<sub>Germany</sub>|<sub>Berlin</sub>|<sub>.KS</sub>|<sub>South Korea</sub>|<sub>Korea</sub>|
|<sub>.BM</sub>|<sub>Germany</sub>|<sub>Bremen</sub>|<sub>.KQ</sub>|<sub>South Korea</sub>|<sub>KOSDAQ</sub>|
|<sub>.DU</sub>|<sub>Germany</sub>|<sub>Dusseldorf</sub>|<sub>.MC</sub>|<sub>Spain</sub>|<sub>Madrid SE C.A.T.S.</sub>|
|<sub>.F</sub>|<sub>Germany</sub>|<sub>Frankfurt</sub>|<sub>.SAU</sub>|<sub>Saudi Arabia</sub>|<sub>Saudi (Tadawul)</sub>|
|<sub>.HM</sub>|<sub>Germany</sub>|<sub>Hamburg</sub>|<sub>.ST</sub>|<sub>Sweden</sub>|<sub>Nasdaq OMX Stockholm</sub>|
|<sub>.HA</sub>|<sub>Germany</sub>|<sub>Hanover</sub>|<sub>.SW</sub>|<sub>Switzerland</sub>|<sub>Swiss Exchange (SIX)</sub>|
|<sub>.MU</sub>|<sub>Germany</sub>|<sub>Munich</sub>|<sub>.TWO</sub>|<sub>Taiwan</sub>|<sub>Taiwan OTC Exchange</sub>|
|<sub>.SG</sub>|<sub>Germany</sub>|<sub>Stuttgart</sub>|<sub>.TW</sub>|<sub>Taiwan</sub>|<sub>Taiwan (TWSE)</sub>|
|<sub>.DE</sub>|<sub>Germany</sub>|<sub>Deutsche Boerse XETRA</sub>|<sub>.BK</sub>|<sub>Thailand (SET)</sub>|
|<sub>.AT</sub>|<sub>Greece</sub>|<sub>Athens (ATHEX)</sub>|<sub>.IS</sub>|<sub>Turkey</sub>|<sub>Borsa İstanbul</sub>|
|<sub>.HK</sub>|<sub>Hong Kong</sub>|<sub>Hong Kong (HKEX)</sub>|<sub>.L</sub>|<sub>United Kingdom</sub>|<sub>London</sub>|
|<sub>.BD</sub>|<sub>Hungary</sub>|<sub>Budapest</sub>|<sub>.IL</sub>|<sub>United Kingdom</sub>|<sub>London</sub>|
|<sub>.IC</sub>|<sub>Iceland</sub>|<sub>Nasdaq OMX Iceland</sub>|<sub>.CR</sub>|<sub>Venezuela</sub>|<sub>Caracas</sub>|
|<sub>.BO</sub>|<sub>India</sub>|<sub>Bombay|


<br>

## FOREX PAIRS

```php
<?php

// Instance Object
$yf = new \floda\yahoo_finance\YF();

//Params
$currency_1="USD";
$currency_2="ARS";

$fx = $yf->getFX($currency_1,$currency_2);

/*
Array
(
    [symbol] => USDARS=X
    [date] => 2020-01-04 5:55:51
    [bid] => 59.729
    [ask] => 59.734
    [high] => 59.73
    [low] => 59.729
    [open] => 59.73
    [previous] => 59.729
    [price] => 59.729
)
*/

```

<br>

## Quote, Order Book, AfterMarket Prices, Financial & Stats

```php
<?php

// Instance Object
$yf = new \floda\yahoo_finance\YF();

//Params
$symbol = "YPF";

$quote = $yf->getQuote($symbol);

/*
Array
(
    [symbol] => YPF
    [price] => 11.16
    [date] => 2020-01-03 21:02:00
    [book] => Array
        (
            [bidSize] => 31
            [bid] => 11.14
            [ask] => 11.57
            [askSize] => 9
        )

    [today] => Array
        (
            [high] => 11.49
            [low] => 10.86
            [open] => 11.24
            [previousDay] => 11.26
            [volume] => 2732642
            [change] => -0.10000038
            [changePercent] => -0.8881029
        )

    [AfterMarket] => Array
        (
            [price] => 11.0746
            [change] => -0.08539963
            [changePercent] => -0.76522964
            [lastTrade] => 2020-01-03 21:26:02
        )

    [financials] => Array
        (
            [name] => YPF Sociedad Anonima
            [mktCap] => 4389372928
            [sharesOutstanding] => 393312992
            [volumeAvg3Month] => 2095557
            [bookValue] => 33.975
            [eps12Month] => 3.125
            [dividendRate] => 0.089
            [dividendYield] => 0.007904085
        )

    [stats] => Array
        (
            [SMA50] => 10.16606
            [SMA200] => 11.737482
            [1yrHigh] => 18.73
            [1yrHighChangePercent] => -0.40416443
            [1yrLow] => 8.04
            [1yrLowChangePercent] => 0.38805968
        )

)
*/


```

<br>

## Symbol - Expiration Dates

```php
<?php

// Instance Object
$yf = new \floda\yahoo_finance\YF();

//Params
$symbol="YPF";

$expirations = $yf->getExpirations($symbol);
/*
Array
(
  [0] => Array
      (
          [unix] => 1578614400
          [days] => 6
          [expiration] => 2020-01-10
      )

  ...
  ...

  [9] => Array
      (
          [unix] => 1642723200
          [days] => 748
          [expiration] => 2022-01-21
      )
)
*/


```

<br>

## Symbol - Expiration - Option Chain

```php
<?php

// Instance Object
$yf = new \floda\yahoo_finance\YF();

//Params
$symbol="AAPL";

$expirations = $yf->getExpirations($symbol);
$contracts = $yf->getContracts($symbol,$expirations[0]['unix']);

/*
Array
(
    [0] => Array
        (
            [symbol] => AAPL
            [spot] => 297.43
            [expiration] => 2020-01-10
            [strike] => 230
            [otm_abs] => 22.67
            [call_contract] => AAPL200110C00230000
            [call_bid] => 67.85
            [call_ask] => 69.6
            [call_lastPrice] => 68.99
            [call_volume] => 18
            [call_openInterest] => 0
            [call_lastTradeDateUNIX] => 1578069878
            [call_lastTradeDate] => 2020-01-03
            [put_contract] => AAPL200110P00230000
            [put_bid] => 0.02
            [put_ask] => 0.03
            [put_lastPrice] => 0.03
            [put_volume] => 6
            [put_openInterest] => 0
            [put_lastTradeDateUNIX] => 1578061990
            [put_lastTradeDate] => 2020-01-03
            [IV] => 95.9
        )

    ...
    ...

    [37] => Array
        (
           [symbol] => AAPL
           [spot] => 297.43
           [expiration] => 2020-01-10
           [strike] => 350
           [otm_abs] => 17.67
           [call_contract] => AAPL200110C00350000
           [call_bid] => 0.02
           [call_ask] => 0.03
           [call_lastPrice] => 0.05
           [call_volume] => 405
           [call_openInterest] => 0
           [call_lastTradeDateUNIX] => 1578084931
           [call_lastTradeDate] => 2020-01-03
           [put_contract] => AAPL200110P00350000
           [put_bid] => 51
           [put_ask] => 51.85
           [put_lastPrice] => 51.7
           [put_volume] => 2
           [put_openInterest] => 0
           [put_lastTradeDateUNIX] => 1577983464
           [put_lastTradeDate] => 2020-01-02
           [IV] => 45.31
        )
)
*/


```

<br>

# Configuration

It doesnt need any configuration line

Enjoy it! :heart:  


<br>

# Credits

[scheb/yahoo-finance-api](https://github.com/scheb/yahoo-finance-api)

<br>

# License

[MIT](https://github.com/gauss314/yahoo_finance/blob/master/LICENSE)
