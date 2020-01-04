# Yahoo Finance non oficial SDK
<p align="center">
<a href="https://packagist.org/packages/floda/yahoo_finance"><img src="https://poser.pugx.org/floda/yahoo_finance/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/floda/yahoo_finance"><img src="https://poser.pugx.org/floda/yahoo_finance/license" alt="License"></a>
</p>

Since YQL APIs have been discontinued in November 2017, this client is using non-official API endpoints for quotes, search and historical data.

**WARNING:** These non-official APIs cannot be assumed stable and might break any time. Also, you might violate Yahoo's terms of service. So use them at your own risk.


# Installation

```shell
$ composer require "floda/yahoo_finance"
```
<br>

# Usage

For Laravel 5, Symfony and any PHP project and framework with a composer.json file

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

Exchanges

<br>

| Sufix     | Country     | City     | Sufix     | Country     | City     |
| :------------- | :------------- | :------------- | :------------- | :------------- | :------------- |
|.BA|Argentina|Buenos Aires (BYMA)|.NS|India|National of India|
|.VI|Austria|Vienna|.JK|Indonesia|Indonesia (IDX)|
|.AX|Australia|Australian (ASX)|.IR|Ireland|Euronext Dublin|
|.BR|Belgium|Euronext Brussels|.TA|Israel|Tel Aviv|
|.SA|Brazil|Sao Paolo (BOVESPA)|.TI|Italy|EuroTLX|
|.CN|Canada|Canadian Securities|.MI|Italy|Italian|
|.NE|Canada|NEO Exchange|.T|Japan|Tokyo|
|.TO|Canada|Toronto (TSX)|.RG|Latvia|Nasdaq OMX Riga|
|.V|Canada|TSX Venture Exchange (TSXV)|.VS|Lithuania|Nasdaq OMX Vilnius|
|.SN|Chile|Santiago|.KL|Malaysia|Malaysian|
|.SS|China|Shanghai|.MX|Mexico|Mexico (BMV)|
|.SZ|China|Shenzhen|.AS|Netherlands|Euronext Amsterdam|
|.PR|Czech Republic|Prague Index|.NZ|New Zealand|New Zealand (NZX)|
|.CO|Denmark|Nasdaq OMX Copenhagen|.OL|Norway|Oslo|
|.CA|Egypt|Egyptian Index (EGID)|.LS|Portugal|Euronext Lisbon|
|.TL|Estonia|Nasdaq OMX Tallinn|.QA|Qatar|Qatar|
|.HE|Finland|Nasdaq OMX Helsinki|.ME|Russia|Moscow Exchange (MOEX)|
|.NX|France|Euronext|.SI|Singapore|Singapore (SGX)|
|.PA|France|Euronext Paris|.JO|South Africa|Johannesburg|
|.BE|Germany|Berlin|.KS|South Korea|Korea|
|.BM|Germany|Bremen|.KQ|South Korea|KOSDAQ|
|.DU|Germany|Dusseldorf|.MC|Spain|Madrid SE C.A.T.S.|
|.F|Germany|Frankfurt|.SAU|Saudi Arabia|Saudi (Tadawul)|
|.HM|Germany|Hamburg|.ST|Sweden|Nasdaq OMX Stockholm|
|.HA|Germany|Hanover|.SW|Switzerland|Swiss Exchange (SIX)|
|.MU|Germany|Munich|.TWO|Taiwan|Taiwan OTC Exchange|
|.SG|Germany|Stuttgart|.TW|Taiwan|Taiwan (TWSE)|
|.DE|Germany|Deutsche Boerse XETRA|.BK|Thailand (SET)|
|.AT|Greece|Athens (ATHEX)|.IS|Turkey|Borsa İstanbul|
|.HK|Hong Kong|Hong Kong (HKEX)|.L|United Kingdom|London|
|.BD|Hungary|Budapest|.IL|United Kingdom|London|
|.IC|Iceland|Nasdaq OMX Iceland|.CR|Venezuela|Caracas|
|.BO|India|Bombay|


<br>

## FOREX PAIRS

<br>


```php
<?php

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

## QUOTES & Entra Data

<br>


```php
<?php

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

## Contracts Expiration Dates

<br>


```php
<?php

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

## Contracts - Option  Chain

<br>


```php
<?php

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
