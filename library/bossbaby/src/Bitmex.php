<?php
namespace BossBaby;

class Bitmex
{
    public static function func_get_current_price($bitmex_instance = null, $symbol = 'XBTUSD', $is_active = true)
    {
        global $environment;

        $list_accounts = $environment->bitmex->accounts;
        $list_id = [];
        foreach ($list_accounts as $key => $account) {$list_id[] = $key;}
        if (!isset($list_id[0])) unset($list_id[0]);
        $rand = array_rand($list_id);
        if ($rand <= 0) return [];
        
        // \BossBaby\Utility::writeLog(__FILE__ . '::' . __FUNCTION__ . '::email::' . $environment->bitmex->accounts->{$rand}->email . '::apiKey::' . $environment->bitmex->accounts->{$rand}->apiKey);
        $bitmex_instance = new \Bitmex($environment->bitmex->accounts->{$rand}->apiKey, $environment->bitmex->accounts->{$rand}->apiSecret);

        $arr = $bitmex_instance->getTicker($symbol);
        // if (is_array($arr) and count($arr)) {
        //     $arr['marketPrice'] = $arr['market_price'];
        //     unset($arr['market_price']);
        // }
        return $arr;
    }

    public static function func_get_account_info($account = null, $apiKey = null, $apiSecret = null, $hide_apiSecret = true)
    {
        $arr = array(
            'Account' => $account,
            'API Key' => $apiKey,
            'API Secret' => ($hide_apiSecret) ? \BossBaby\Utility::func_replace_by_star($apiSecret) : $apiSecret,
        );
        return $arr;
    }
    
    public static function func_get_account_wallet($bitmex_instance = null)
    {
        if (!$bitmex_instance) return array();

        $arr = $bitmex_instance->getWallet();
        return $arr;
    }

    public static function func_get_open_positions($bitmex_instance = null)
    {
        if (!$bitmex_instance) return array();

        $arr = $bitmex_instance->getOpenPositions();
        return $arr;
    }

    public static function func_get_open_orders($bitmex_instance = null)
    {
        if (!$bitmex_instance) return array();

        $arr = $bitmex_instance->getOpenOrders();
        return $arr;
    }

    public static function func_get_margin($bitmex_instance = null)
    {
        if (!$bitmex_instance) return array();

        $arr = $bitmex_instance->getMargin();
        return $arr;
    }
    
    public static function func_get_orderbook($bitmex_instance = null, $depth = 10)
    {
        if (!$bitmex_instance) return array();

        $arr = $bitmex_instance->getOrderBook($depth);
        return $arr;
    }

    public static function func_get_orders($bitmex_instance = null, $depth = 10)
    {
        if (!$bitmex_instance) return array();

        $arr = $bitmex_instance->getOrders($depth);
        return $arr;
    }

    public static function func_get_order($bitmex_instance = null, $orderID = 0, $count = 10)
    {
        if (!$bitmex_instance) return array();

        $arr = $bitmex_instance->getOrder($orderID, $count);
        return $arr;
    }
}