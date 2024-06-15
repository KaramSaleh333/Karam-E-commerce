<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class PaymentServices {

    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('fatoorah_base_url');
        $this->headers = [
            'Authorization'=>env('fatoorah_token'),
            'Content-Type' => 'application/json',
            
        ];
    }

    private function buildRequest($uri , $method , $data=[])
    {
        $request = new Request($method , $this->base_url.$uri , $this->headers);

        if(!$data){
            return false;
        }

        $response = $this->request_client->send($request ,[
            'json' => $data
        ]);


        if($response->getStatusCode() != 200){
            return false;
        }

        $response = json_decode($response->getbody() , true);
        return $response;
        // return redirect($response['Data']['InvoiceURL']);
    }

    public function sendPayment($data)
    {
        return $this->buildRequest('v2/SendPayment' , 'post' , $data);
    }

    public function getPaymentStatus($data)
    {
        return $this->buildRequest('v2/GetPaymentStatus' , 'post' , $data);
    }

    public function saveTransactionPayment($user_id , $invoice_id)
    {

    }

    public function transactionCallBack($request)
    {
        return $request;
    }

}