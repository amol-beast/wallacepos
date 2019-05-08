<?php

/**
 * Created by PhpStorm.
 * User: SLND
 * Date: 4/9/2018
 * Time: 10:40 PM
 */
class WposBusyInterface
{
    protected $busy_bridge_url;

    protected function init()
    {
        $config_model = new ConfigModel();
        $config = $config_model->get("busy_integration_config")[0];
        //$output = print_r($config, true);
        //file_put_contents('file.txt', $output);
        $this->busy_bridge_url = json_decode($config["data"])->busy_bridge_url;
        //$this->busy_bridge_url = "http://localhost:9085/";

    }
    public function informBusyBridge()
    {
        $this->init();
        $url = $this->busy_bridge_url."/hook/activity/sales";
        $error = new \stdClass();
        $urls = [
            $url,
        ];

        $asyncRequest = new AsyncRequest\AsyncRequest();

        foreach ($urls as $url) {
            $request = new AsyncRequest\Request($url);
            $asyncRequest->enqueue($request, function(AsyncRequest\Response $response) {
                //echo $response->getBody() . "\n";
            });
        }
        $asyncRequest->run();
    }
    public function getLastSalesId($data)
    {
        $this->init();
        $url = $this->busy_bridge_url."/getCurrentBusySaleVoucherID";

        $ch = curl_init();
        $val = "location=".$data;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            $val);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        return $server_output;
        $vchNo = json_decode($server_output);

    }


}