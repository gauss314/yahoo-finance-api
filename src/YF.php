<?php
namespace gauss314\yahoo_finance;
use Scheb\YahooFinanceApi\ApiClient;
use Scheb\YahooFinanceApi\ApiClientFactory;
use GuzzleHttp\Client;

class YF {

  public function promedio($array,$decimales=2){
    $array=array_filter($array);
    $prom = (count($array)>0)? round(array_sum($array)/count($array),$decimales) : NULL;
    return $prom;
  }

  public function diasEntre($fecha_i,$fecha_f)
  {
    $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
    $dias 	= abs($dias); $dias = floor($dias);
    return $dias;
  }


  public function getHistorical($symbol,$time_ago){
    /*
      Constantes intervalos: se puede incluir funcionalidad de datos por semana o por mes a futuro
          INTERVAL_1_DAY
          INTERVAL_1_WEEK
          INTERVAL_1_MONTH
    */
    $time_ago = "-".$time_ago;
    $client = ApiClientFactory::createApiClient();
    $historicalData = $client->getHistoricalData($symbol, ApiClient::INTERVAL_1_DAY, new \DateTime($time_ago), new \DateTime("today"));

    foreach ($historicalData as $key => $value) {
      $ret[$key]['date']=date_format($value->getDate(), 'Y-m-d');
      $ret[$key]['open']=$value->getOpen();
      $ret[$key]['high']=$value->getHigh();
      $ret[$key]['low']=$value->getLow();
      $ret[$key]['close']=$value->getClose();
      $ret[$key]['adjClose']=$value->getAdjClose();
      $ret[$key]['volume']=$value->getVolume();
    }
    return $ret;
  }


  public function getFX($currency_1,$currency_2){
    $client = ApiClientFactory::createApiClient();
    $exchangeRates = $client->getExchangeRate($currency_1,$currency_2);
      $ret['symbol']=$exchangeRates->getSymbol();
      $ret['date']=date_format($exchangeRates->getRegularMarketTime(), 'Y-m-d G:i:s');
      $ret['bid']=$exchangeRates->getBid();
      $ret['ask']=$exchangeRates->getAsk();
      $ret['high']=$exchangeRates->getRegularMarketDayHigh();
      $ret['low']=$exchangeRates->getRegularMarketDayLow();
      $ret['open']=$exchangeRates->getRegularMarketOpen();
      $ret['previousDay']=$exchangeRates->getregularMarketPreviousClose();
      $ret['price']=$exchangeRates->getRegularMarketPrice();
    return $ret;
  }

  public function getQuote($symbol){
    $client = ApiClientFactory::createApiClient();
    $quote = $client->getQuote($symbol);

    $ret['symbol']=$quote->getSymbol();
    $ret['price']=$quote->getRegularMarketPrice();
    $ret['date']=date_format($quote->getRegularMarketTime(), 'Y-m-d G:i:s');

    $ret['book']['bidSize']=$quote->getBidSize();
    $ret['book']['bid']=$quote->getBid();
    $ret['book']['ask']=$quote->getAsk();
    $ret['book']['askSize']=$quote->getAskSize();

    $ret['today']['high']=$quote->getRegularMarketDayHigh();
    $ret['today']['low']=$quote->getRegularMarketDayLow();
    $ret['today']['open']=$quote->getRegularMarketOpen();
    $ret['today']['previousDay']=$quote->getregularMarketPreviousClose();
    $ret['today']['volume']=$quote->getRegularMarketVolume();
    $ret['today']['change']=$quote->getRegularMarketChange();
    $ret['today']['changePercent']=$quote->getRegularMarketChangePercent();

    if ($quote->getPostMarketTime()) {
      $ret['AfterMarket']['price']=$quote->getPostMarketPrice();
      $ret['AfterMarket']['change']=$quote->getPostMarketChange();
      $ret['AfterMarket']['changePercent']=$quote->getPostMarketChangePercent();
      $ret['AfterMarket']['lastTrade']=date_format($quote->getPostMarketTime(), 'Y-m-d G:i:s');
    }
    $ret['financials']['name']=$quote->getShortName();
    $ret['financials']['mktCap']=$quote->getMarketCap();
    $ret['financials']['sharesOutstanding']=$quote->getSharesOutstanding();
    $ret['financials']['volumeAvg3Month']=$quote->getAverageDailyVolume3Month();
    $ret['financials']['bookValue']=$quote->getBookValue();
    $ret['financials']['eps12Month']=$quote->getEpsTrailingTwelveMonths();
    $ret['financials']['dividendRate']=$quote->getTrailingAnnualDividendRate();
    $ret['financials']['dividendYield']=$quote->getTrailingAnnualDividendYield();

    $ret['stats']['SMA50']=$quote->getFiftyDayAverage();
    $ret['stats']['SMA200']=$quote->getTwoHundredDayAverage();
    $ret['stats']['1yrHigh']=$quote->getFiftyTwoWeekHigh();
    $ret['stats']['1yrHighChangePercent']=$quote->getFiftyTwoWeekHighChangePercent();
    $ret['stats']['1yrLow']=$quote->getFiftyTwoWeekLow();
    $ret['stats']['1yrLowChangePercent']=$quote->getFiftyTwoWeekLowChangePercent();

    return $ret;
  }

  public function getExpirations($symbol){
      $hoyUNIX=date("U");
      $url="https://es.finance.yahoo.com/quote/$symbol/options";
      $dataWEB=file_get_contents($url);
      $vencimientos_unix=json_decode(explode(',"hasMiniOptions"',explode('expirationDates":', $dataWEB)[1])[0],true);
      foreach ($vencimientos_unix as $key => $value) {
        $vencimientos[$key]['unix']=$value;
        $vencimientos[$key]['days'] = round(($value-$hoyUNIX)/(24*3600));
        $vencimientos[$key]['expiration']=date("Y-m-d", strtotime(date("Y-m-d",$value).' + 1 days'));
      }
      return $vencimientos;
  }

  public function getContracts($symbol,$expiration){
    $url="https://es.finance.yahoo.com/quote/$symbol/options?date=$expiration&straddle=true&p=$symbol";
    $dataWEB=file_get_contents($url);
    $spot = explode('</span>',explode('Trsdu(0.3s) Fw(b) Fz(36px) Mb(-4px) D(ib)" data-reactid="34">', $dataWEB)[1])[0];
    $spot = str_replace(",", ".", $spot);
    $cadena=explode('{"call.change', $dataWEB);
    $rta=[];
    foreach ($cadena as $key => $value) {
      if ($key>0) {
        $reg='{"call.change'.$value;
        $reg=substr($reg,0, -1);
        $r=json_decode($reg,true);
        $rta[]=$r;
      }
    }
    foreach ($rta as $key => $value) {
      if (count($value)==0) {
        $inicio=$key;
        break(1);
      }
    }
    $rtaOk=[];
    foreach ($rta as $key => $value) {
      if ($key>$inicio) {
        $rtaOk[]=$value;
      }
    }
    $result['spot']=$spot;
    $result['cadena']=array_filter($rtaOk);

    $resultForm = $this->formatearCadena($result['cadena'],$symbol,$expiration,$result['spot']);
    return $resultForm;
  }


  public function formatearCadena($cadena,$simbolo,$vencimiento,$spot){
    foreach ($cadena as $key => $value) {
      $otm_abs=abs(($value['strike']['raw']/$spot-1)*100);
      if ($otm_abs<30 && isset($value['put.contractSymbol']) && isset($value['call.contractSymbol'])) {
        $strike=$value['strike']['raw'];
        $rta[$strike]['symbol']=$simbolo;
        $rta[$strike]['spot']=$spot;
        $rta[$strike]['expiration']=date("Y-m-d",strtotime(date("Y-m-d",$vencimiento)."+ 1 day"));
        $rta[$strike]['strike']=$value['strike']['raw'];
        $rta[$strike]['otm_abs']=round($otm_abs,2);
        $rta[$strike]['call_contract']=$value['call.contractSymbol'];
        $rta[$strike]['call_bid']=$value['call.bid']['raw'];
        $rta[$strike]['call_ask']=$value['call.ask']['raw'];
        $rta[$strike]['call_lastPrice']=$value['call.lastPrice']['raw'];
        $call_iv=round($value['call.impliedVolatility']['raw']*100,2);
          $call_iv=($call_iv>0)? $call_iv : NULL;
        $rta[$strike]['call_volume']= (isset($value['call.volume']['raw']))?  $value['call.volume']['raw'] : NULL;
        $rta[$strike]['call_openInterest']=$value['call.openInterest']['raw'];
        $rta[$strike]['call_lastTradeDateUNIX']=$value['call.lastTradeDate']['raw'];
        $rta[$strike]['call_lastTradeDate']=$value['call.lastTradeDate']['fmt'];
        $rta[$strike]['put_contract']=$value['put.contractSymbol'];
        $rta[$strike]['put_bid']=$value['put.bid']['raw'];
        $rta[$strike]['put_ask']=$value['put.ask']['raw'];
        $rta[$strike]['put_lastPrice']=$value['put.lastPrice']['raw'];
        $put_iv=round($value['put.impliedVolatility']['raw']*100,2);
        $put_iv=($put_iv>0)? $put_iv : NULL;
        $rta[$strike]['put_volume']= (isset($value['put.volume']['raw']))? $value['put.volume']['raw'] : NULL;
        $rta[$strike]['put_openInterest']=$value['put.openInterest']['raw'];
        $rta[$strike]['put_lastTradeDateUNIX']=$value['put.lastTradeDate']['raw'];
        $rta[$strike]['put_lastTradeDate']=$value['put.lastTradeDate']['fmt'];
        $rta[$strike]['IV']=$this->promedio([$call_iv,$put_iv]);

        $call_mkt=($rta[$strike]['call_bid']+$rta[$strike]['call_ask'])/2;
        $put_mkt=($rta[$strike]['put_bid']+$rta[$strike]['put_ask'])/2;
        $tiempo = $this->diasEntre(date("Y-m-d"),$vencimiento['vencimiento']) / 365;
      }
    }
    if ($rta) {
      return array_values($rta);
    }else {
      return NULL;
    }
  }


  
}
 ?>
