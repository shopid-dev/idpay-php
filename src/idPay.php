<?php
/*
        https://www.shopid.ir
        https://github.com/shopid-dev
        alaeebehnam@gmail.com
        https://t.me/theycallmebehnam

*/

namespace shopid;


class idPay
{
    private  $xAPIKey;
    private  $sandbox = false;
    function __construct($param)
    {

        $this->xAPIKey = $param['apiKey'];

        if (isset($param['sandbox']) && $param['sandbox'] == true) {
            $this->sandbox = true;
        }
    }


    private function reqHeaders()
    {

        $reqheaders = array(
            'Content-Type: application/json',
            'X-API-KEY: ' . $this->xAPIKey,

        );

        if ($this->sandbox == true) {
            $reqheaders[] = "X-SANDBOX: 1";
        }

        return $reqheaders;
    }

    public function apiRequest($param)
    {

        $data = array(
            "order_id" => $param['order_id'],
            "amount" => $param['amount'],
            "callback" => $param['callback'],
            "name" => $param['name'],
            "phone" => $param['phone'],
            "mail" => $param['mail'],
            "desc" => $param['desc'],
        );

        $jsonData = json_encode($data);
        $ch = curl_init('https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->reqHeaders());

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);



        if ($err) {

            throw new \Exception(json_encode(["error" => ["code" => 9999, "message" => $err]]));
        } else {
            if ($http_code == 201) {

                return json_encode(["url" => $result['link'], "id" => $result['id']]);
            } else {

                throw new \Exception(json_encode([
                    "error" =>
                    ["response_code" => $http_code, "code" => $result['error_code'], "message" => $result['error_message']]
                ]));
            }
        }
    }


    public function verify($param)
    {

        $data = array("id" => $param['id'], "order_id" => $param['order_id']);
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->reqHeaders());

        $result = curl_exec($ch);
        $err = curl_error($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result = json_decode($result, true);

        if ($err) {

            throw new \Exception(json_encode(["error" => ["code" => 9999, "message" => $err]]));
        } else {

            if ($http_code == 200) {
                return json_encode($result);
            } else {


                throw new \Exception(json_encode([
                    "error" =>
                    ["response_code" => $http_code, "code" => $result['error_code'], "message" => $result['error_message']]
                ]));
            }
        }
    }
}
