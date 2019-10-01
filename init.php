<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/1
 * Time: 14:09
 */
require_once __DIR__ . '/vendor/autoload.php';
use Workerman\Worker;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

date_default_timezone_set('Asia/Shanghai');

$log = new Logger('log');
$log->pushHandler(new StreamHandler(__DIR__ . '/data/log.log', Logger::INFO));

// #### http worker ####
$http_worker = new Worker("http://0.0.0.0:2345");

// 4 processes
$http_worker->count = 4;

// Emitted when data received
$http_worker->onMessage = function($connection, $data) use($log)
{
    //操作仓库
    if (isset($_GET['git_cmd']) && isset($_GET['git_url'])) {
        $git_cmd = $_GET['git_cmd'];
        $git_url = $_GET['git_url'];

        $configs =  require __DIR__ . '/config/gitconfig.php';

        $config = [];


        foreach ($configs as $config_temp) {
            if ($config_temp['url'] == $git_url) {
                $config = $config_temp;
                break;
            }
        }

        if ($config) {


            if (!isset($config['cmd'][$git_cmd])) {
                $connection->send("no this cmd \n");
            } else {
                chdir($config['path']);
                $file = __DIR__ . '/data/' . md5($config['cmd'][$git_cmd] . $git_url) . '.temp';

                if (!file_exists($file)) {
                    file_put_contents($file, 'now is cmd');

                    exec($config['cmd'][$git_cmd], $output);

                    unlink($file);

                    $connection->send(json_encode($output));
                    $log->info(json_encode($output));

                } else {
                    $connection->send("now is cmd \n");
                }

            }

        }

    } else {
        // send data to client
        $connection->send("error \n");
    }

};

// run all workers
Worker::runAll();