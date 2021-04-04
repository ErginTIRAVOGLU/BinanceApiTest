<?php
$apikey = "Ch3eZ1qi44ANaiXrrWxDqtR9GDNE5gvh4ebdk4OgNfFKJHkcMWvPKtY7C6BRsU9j";
$apisecret = "4tovPpXpDIzdOj484TXRwGXW8sU5VOhgrP9oxzxVoxRsis37E0uAJ4kav7NkWNFO";
$url="https://testnet.binance.vision";
$timestamp= time()*1000;
 

if (!empty($_POST))
{
    $signature= hash_hmac('sha256', 'symbol='. $_POST["firstsemb"] .'USDT&side=SELL&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp, $apisecret);
    /*print_r($_POST["first"]);
    print_r($_POST["firstsemb"]);
    print_r($_POST["secondsemb"]);*/
     
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url. '/api/v3/order?symbol='. $_POST["firstsemb"] .'USDT&side=SELL&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp.'&signature='.$signature);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","X-MBX-APIKEY: ".$apikey));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, 'symbol='. $_POST["firstsemb"] .'USDT&side=SELL&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp);
    $response = curl_exec($ch);
 
    curl_close($ch);
    $satis = json_decode($response,true);
    //var_dump($satis);
//print_r($satis["status"]);
    if(isset($satis["code"]))
    {
        $satis["status"]=$satis["msg"];
    }
    else
    {
        if($satis["status"]=="FILLED"){
            $kur=
            $signature= hash_hmac('sha256', 'symbol='. $_POST["secondsemb"] .'USDT&side=BUY&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp, $apisecret);
            /*print_r($_POST["first"]);
            print_r($_POST["firstsemb"]);
            print_r($_POST["secondsemb"]);*/
            
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url. '/api/v3/order?symbol='. $_POST["secondsemb"] .'USDT&side=BUY&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp.'&signature='.$signature);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","X-MBX-APIKEY: ".$apikey));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, 'symbol='. $_POST["firstsemb"] .'USDT&side=SELL&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp);
        // $response = curl_exec($ch);
        
            curl_close($ch);
    
            $json = json_decode($response,true);
            //var_dump( $json);
        }
    }
    
}


$signature= hash_hmac('sha256', "timestamp=".$timestamp, $apisecret);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url.'/api/v3/ticker/price');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","X-MBX-APIKEY: ".$apikey));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
 
curl_close($ch);

$fiyatlar = json_decode($response,true);
//var_dump($fiyatlar);



 

if (!empty($_POST))
{
    $signature= hash_hmac('sha256', 'symbol='. $_POST["firstsemb"] .'USDT&side=SELL&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp, $apisecret);
    /*print_r($_POST["first"]);
    print_r($_POST["firstsemb"]);
    print_r($_POST["secondsemb"]);*/
     
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url. '/api/v3/order?symbol='. $_POST["firstsemb"] .'USDT&side=SELL&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp.'&signature='.$signature);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","X-MBX-APIKEY: ".$apikey));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, 'symbol='. $_POST["firstsemb"] .'USDT&side=SELL&type=MARKET&quantity='.$_POST["first"].'&timestamp='.$timestamp);
    $response = curl_exec($ch);
 
    curl_close($ch);
    $satis = json_decode($response,true);
    //var_dump($satis);
//print_r($satis["status"]);
    if(isset($satis["code"]))
    {
        $satis["status"]=$satis["msg"];
    }
    else
    {
        if($satis["status"]=="FILLED"){
            $kur=0;
            $tutar=0;
            $ilkFiyatKur=0;
            $ikinciFiyatKur=0;
            
            for ($i=0; $i < count($fiyatlar) ; $i++) { 
                if($fiyatlar[$i]["symbol"]==$_POST["firstsemb"] .'USDT')
                {
                    $ilkFiyatKur=$fiyatlar[$i]["price"];
                }
                if($fiyatlar[$i]["symbol"]==$_POST["secondsemb"] .'USDT')
                {
                    $ikinciFiyatKur=$fiyatlar[$i]["price"];
                }
                
            }
            $kur=$ilkFiyatKur/$ikinciFiyatKur;

            $tutar = $_POST["first"] * $kur;
            

            $signature= hash_hmac('sha256', 'symbol='. $_POST["secondsemb"] .'USDT&side=BUY&type=MARKET&quantity='.$tutar.'&timestamp='.$timestamp, $apisecret);
            /*print_r($_POST["first"]);
            print_r($_POST["firstsemb"]);
            print_r($_POST["secondsemb"]);*/
            
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url. '/api/v3/order?symbol='. $_POST["secondsemb"] .'USDT&side=BUY&type=MARKET&quantity='.$tutar.'&timestamp='.$timestamp.'&signature='.$signature);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","X-MBX-APIKEY: ".$apikey));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
 
         $alis = curl_exec($ch);
        
            curl_close($ch);
    
            $json = json_decode($alis,true);
            //var_dump( $json);
        }
    }
    
}

$signature= hash_hmac('sha256', "timestamp=".$timestamp, $apisecret);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url.'/api/v3/account?timestamp='.$timestamp.'&signature='.$signature);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","X-MBX-APIKEY: ".$apikey));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
 
curl_close($ch);

$json = json_decode($response,true);
//$json = json_encode($json);
//header('Content-Type: application/json');
//print_r($json["balances"]);
//var_dump($json);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script type='text/javascript'>
    <?php
     
    $js_array = json_encode($json["balances"]);
    echo "var js_array = ". $js_array . ";\n";
    ?>
    console.log(js_array);
    console.log(js_array[0]["asset"]);
    </script>

</head>
<body>
 <a href="intent://arvr.google.com/scene-viewer/1.0?file=https://raw.githubusercontent.com/KhronosGroup/glTF-Sample-Models/master/2.0/Avocado/glTF/Avocado.gltf#Intent;scheme=https;package=com.google.android.googlequicksearchbox;action=android.intent.action.VIEW;S.browser_fallback_url=https://developers.google.com/ar;end;">Avocado</a>

    <div>
    <?php
        for ($i=0; $i < count($fiyatlar) ; $i++) { 
            echo ($fiyatlar[$i]["symbol"] . ' : '.$fiyatlar[$i]["price"] . '<br />');
        }
    ?>
    </div>
        <hr />
    <div>
    <?php
        for ($i=0; $i < count($json["balances"]) ; $i++) { 
            echo ($json["balances"][$i]["asset"] . ' : '.$json["balances"][$i]["free"] . '<br />');
        }
    ?>
    </div>
        <hr />
    <form method="post" action="index.php">
    <input type="text" value="" id="first" name="first"/>
    <select id="firstsemb" name="firstsemb">
        <?php
            for ($i=0; $i < count($json["balances"]) ; $i++) { 
                echo ('<option value="' . $json["balances"][$i]["asset"] . '">' .$json["balances"][$i]["asset"] .'</option>');
            }
        ?>
    </select>
    <input type="text" value="" id="second" name="second" disabled/>
    <select id="secondsemb" name="secondsemb">
        <?php
            for ($i=0; $i < count($json["balances"]) ; $i++) { 
                echo ('<option value="' . $json["balances"][$i]["asset"] . '">' .$json["balances"][$i]["asset"] .'</option>');
            }
        ?>
    </select>
    <br />
    <button type="submit" name="submit" id="submit" > Gönder </button>
    </form>
    <?php
        if (!empty($_POST))
        {
    ?>
    <div>
    Satış Durum : <?php print_r($satis["status"]); ?>
    </div>

    <?php
        }
    ?>
</body>
</html>
<?php
/*
    $signature= hash_hmac('sha256', 'quoteAsset='. $_POST["firstsemb"] .'&baseAsset='. $_POST["secondsemb"] .'&quoteQty='. $_POST["first"] .'&timestamp=timestamp='.$timestamp, $apisecret);
 
     
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url. '/sapi/v1/bswap/swap?quoteAsset='. $_POST["firstsemb"] .'&baseAsset='. $_POST["secondsemb"] .'&quoteQty='. $_POST["first"] .'&timestamp='.$timestamp.'&signature='.$signature);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","X-MBX-APIKEY: ".$apikey));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
 
    curl_close($ch);

    $json = json_decode($response,true);
    var_dump( $json);
    */
    ?>
