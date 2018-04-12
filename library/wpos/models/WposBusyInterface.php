<?php

/**
 * Created by PhpStorm.
 * User: SLND
 * Date: 4/9/2018
 * Time: 10:40 PM
 */
class WposBusyInterface
{
    public function informBusyBridge()
    {
        $url = "b.com/hook/activity";
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
        /*
        $timeout = 10;
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
        $http_respond = curl_exec($ch);
        $http_respond = trim( strip_tags( $http_respond ) );
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $error = new \stdClass();
        //dd(get_defined_vars());
        if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
            $error->code=0;
        } else {
            // return $http_code;, possible too
            $error->code=1;
        }
        $error->http_code=$http_code;
        curl_close( $ch );*/

        //return json_encode($error);
    }


}