 <?php
 
 class mySoapClient extends SoapClient {
    public function __call($method, $parameters) {
        return $this->__soapCall($method, $parameters);
    }
}
 
 
$url = "http://91.103.29.188:81/IdealWs.wsdl";
//$save = new SoapClient($url,array("trace" => 1,"connection_timeout"=>10000));

$save = new mySoapClient($url,
    array(
        "trace" => 1,
        //"location" => "http://http://91.103.29.188:81/",
        'exceptions' => 1,
        "stream_context" => stream_context_create(
            array(
                'ssl' => array(
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                )
            )
        )
    ) 
);




//$param= array(1010, 3, 3, '-', '-', null);
//$update= $save->__soapCall(InsertIntoWebSalesCheck,$param);

$param= array(1010,  null);
$update= $save->__call(CreateWebSalesCheckS,$param);


echo "Response:\n" . $client->__getLastResponse() . "\n";



