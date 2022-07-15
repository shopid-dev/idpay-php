# idpay php package for laravel and any php framework

Installation
```
composer require shopid/idpay

```
on virgool.io :

https://virgool.io/@shopid/%D8%AF%D8%B1%DA%AF%D8%A7%D9%87-%D9%BE%D8%B1%D8%AF%D8%A7%D8%AE%D8%AA-%D8%A2%DB%8C%D8%AF%DB%8C-%D9%BE%DB%8C-idpay-%D8%A8%D8%B1%D8%A7%DB%8C-%D9%84%D8%A7%D8%B1%D8%A7%D9%88%D9%84-nmdekqgqmtad

```php
<?php

//make idpay object
$idpay = new idPay(["apiKey"=>"6a7f99eb-7c20-4412-a972-6dfb7cd253a4","sandbox"=>true]);

//make a request

try {
$req = $idpay->apiRequest([

	    "order_id" => "1123",
            "amount" => 2000,
            "callback" => "https://www.mywebsite.com/",
            "name" => "shopid",
            "phone" => "09120000000",
            "mail" => "aa@gmail.com",
            "desc" => "order 1123",
]);

print_r(json_decode($req));
} catch (Exception $error) {
      print_r(json_decode($error->getMessage()));
}


//verify peyment
try {
    
    $verify = $idpay->verify(
        [
	        "order_id" => "1123",        
            "id" => "350130d9fc8b5b569fecb600538f7e72",
        ]
    );
    var_dump(json_decode($verify));
} catch (Exception $error) {
          print_r(json_decode($error->getMessage()));
}

?>
```

