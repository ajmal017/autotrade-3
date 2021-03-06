<?php
/**
 * README
 * This configuration file is intended to run a list of commands with crontab.
 * Uncommented parameters must be filled
 */

if (!defined('STDIN')) die('Access denied.' . "\n");

// Error handle
require_once __DIR__ . '/../error-handle.php';

run_cron();
$sleep = 10;
sleep($sleep); run_cron();
sleep($sleep); run_cron();
sleep($sleep); run_cron();
sleep($sleep); run_cron();

function run_cron() {
    // \BossBaby\Utility::writeLog(__FILE__ . '::' . __FUNCTION__ . '::' . date('YmdHis'));
    
    // Run cron to update coin from exchange
    $tmp = \BossBaby\Binance::get_ticker_24h();
    // \BossBaby\Utility::writeLog('tmp:'.serialize($tmp));

    if ($tmp) {
        $arr = [];
        $arr['symbols'] = [];
        $arr['last_updated'] = date('Y-m-d H:i:s');
        $arr['last_updated_unix'] = time();

        foreach ($tmp as $pos => $item) {
            $coin = $item['symbol'];
            $arr['symbols'][$coin] = $item;
            $arr['symbols'][$coin]['price'] = $item['lastPrice'];
            $arr['symbols'][$coin]['coinVolume'] = $item['volume'];
            $arr['symbols'][$coin]['volume'] = $item['quoteVolume'];
        }
        unset($tmp);

        if ($arr) {
            // File store coin data
            $file = CONFIG_DIR . '/binance_coins.php';
            $file_tmp = $file . '.lock';
            // \BossBaby\Utility::writeLog('file:'.serialize($file));

            // Write overwrite to file
            $arr = json_encode($arr);
            \BossBaby\Config::write_file($file, $arr);
            unset($arr);
            sleep(1);

            if (is_file($file_tmp) and file_exists($file_tmp)) {
                @rename($file_tmp, $file);
                // sleep(1);
            }

            // die('UPDATED');
        }
    }

    // die('NOTHING');
}
