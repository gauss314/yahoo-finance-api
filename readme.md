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


```php
<?php

// Instance Object
$yf = new \gauss314\yahoo_finance\YF();

/*
******************************************************************************************************************
        ------------------ ------------------ GET HISTORICAL QUOTES ------------------ ------------------
******************************************************************************************************************
*/
$symbol ="TRAN.BA";       //tickers with no .XX, API will return US stock market ticker  
                          //for example: $symbol="AAPL";

                          /*
                          For another countries, you can use for example:
                              .BA -> Argentina -> Buenos Aires Stock Exchange (BYMA)
                              .VI -> Austria -> Vienna Stock Exchange
                              .AX -> Australia -> Australian Stock Exchange (ASX)
                              .BR -> Belgium -> Euronext Brussels
                              .SA -> Brazil -> Sao Paolo Stock Exchange (BOVESPA)
                              .CN -> Canada -> Canadian Securities Exchange
                              .NE -> Canada -> NEO Exchange
                              .TO -> Canada -> Toronto Stock Exchange (TSX)
                              .V  -> Canada -> TSX Venture Exchange (TSXV)
                              .SN -> Chile -> Santiago Stock Exchange
                              .SS -> China -> Shanghai Stock Exchange
                              .SZ -> China -> Shenzhen Stock Exchange
                              .PR -> Czech Republic -> Prague Stock Exchange Index
                              .CO -> Denmark -> Nasdaq OMX Copenhagen
                              .CA -> Egypt -> Egyptian Exchange Index (EGID)
                              .TL -> Estonia -> Nasdaq OMX Tallinn
                              .HE -> Finland -> Nasdaq OMX Helsinki
                              .NX -> France -> Euronext
                              .PA -> France -> Euronext Paris
                              .BE -> Germany -> Berlin Stock Exchange
                              .BM -> Germany -> Bremen Stock Exchange
                              .DU -> Germany -> Dusseldorf Stock Exchange
                              .F  -> Germany -> Frankfurt Stock Exchange
                              .HM -> Germany -> Hamburg Stock Exchange
                              .HA -> Germany -> Hanover Stock Exchange
                              .MU -> Germany -> Munich Stock Exchange
                              .SG -> Germany -> Stuttgart Stock Exchange
                              .DE -> Germany -> Deutsche Boerse XETRA
                              .AT -> Greece -> Athens Stock Exchange (ATHEX)
                              .HK -> Hong Kong -> Hong Kong Stock Exchange (HKEX)
                              .BD -> Hungary -> Budapest Stock Exchange
                              .IC -> Iceland -> Nasdaq OMX Iceland
                              .BO -> India -> Bombay Stock Exchange
                              .NS -> India -> National Stock Exchange of India
                              .JK -> Indonesia -> Indonesia Stock Exchange (IDX)
                              .IR -> Ireland -> Euronext Dublin
                              .TA -> Israel -> Tel Aviv Stock Exchange
                              .TI -> Italy -> EuroTLX
                              .MI -> Italy -> Italian Stock Exchange
                              .T  -> Japan -> Tokyo Stock Exchange
                              .RG -> Latvia -> Nasdaq OMX Riga
                              .VS -> Lithuania -> Nasdaq OMX Vilnius
                              .KL -> Malaysia -> Malaysian Stock Exchange
                              .MX -> Mexico -> Mexico Stock Exchange (BMV)
                              .AS -> Netherlands -> Euronext Amsterdam
                              .NZ -> New Zealand -> New Zealand Stock Exchange (NZX)
                              .OL -> Norway -> Oslo Stock Exchange
                              .LS -> Portugal -> Euronext Lisbon
                              .QA -> Qatar -> Qatar Stock Exchange
                              .ME -> Russia -> Moscow Exchange (MOEX)
                              .SI -> Singapore -> Singapore Stock Exchange (SGX)
                              .JO -> South Africa -> Johannesburg Stock Exchange
                              .KS -> South Korea -> Korea Stock Exchange
                              .KQ -> South Korea -> KOSDAQ
                              .MC -> Spain -> Madrid SE C.A.T.S.
                              .ST -> Sweden -> Nasdaq OMX Stockholm
                              .SW -> Switzerland -> Swiss Exchange (SIX)
                              .TW -> Taiwan -> Taiwan Stock Exchange (TWSE)
                              .BK -> Thailand -> Stock Exchange of Thailand (SET)
                              .IS -> Turkey -> Borsa İstanbul
                              .L  -> United Kingdom -> London Stock Exchange
                              .IL -> United Kingdom -> London Stock Exchange
                              .CR -> Venezuela -> Caracas Stock Exchange
                          */

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


/*
******************************************************************************************************************
            ------------------ ------------------ GET FOREX PAIRS ------------------ ------------------
******************************************************************************************************************
*/
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


/*
******************************************************************************************************************
      ------------------ ------------------ GET QUOTE AND EXTRA DATA ------------------ ------------------
******************************************************************************************************************
*/
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



/*
******************************************************************************************************************    
    ----------------- ------------------ GET CONTRACTS EXPIRATION DATES ------------------ ------------------
******************************************************************************************************************
*/

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


/*
******************************************************************************************************************
          ------------------ ------------------ GET OPTION CHAINS ------------------ ------------------
******************************************************************************************************************
*/

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
