# idpay php package for laravel and any php framework

Installation
```

```
on virgool.io :



```php
<?php

//make idpay object
$idpay = new idPay(["apiKey"=>"6a7f99eb-7c20-4412-a972-6dfb7cd253a4","sandbox"=>true]);

//make a request

try {
$req = $x->apiRequest([

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

