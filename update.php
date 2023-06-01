#######PHP CODE to update CloudFlare Zero Trust Dynamic IP  using curl+php #####

<?php
/*
Script Author: Vitor Magalhães
How setup:
Firts thing to configure is get the proper respose for the curl command bellow, WITH IT YOU WILL GET THE ID OF THE LOCATION

CURL COMMAND 1:  
curl --request GET \
  --url https://api.cloudflare.com/client/v4/accounts/PUT-HERE-THE-API-TOKEN/gateway/locations \ // put your Cloudflare API token here (this one CAN BE FOUND on zero trust dashboard URL) exemple: (https://one.dash.cloudflare.com/WILL-BE-HERE/gateway/locations )
  --header 'Content-Type: application/json' \
  --header 'X-Auth-Key: ' \    // PUT HERE Your Cloudflare global API AUTH key here, find it in PROFILE -> dashboard
  --header 'X-Auth-Email: my@email.com' // put your email here

*/

// This is to use without dynamic ip hostname
// $ip = $_SERVER['REMOTE_ADDR'];

//This is to use with dynamic ip hostname

$ip = gethostbyname("YOUR.DYNAMIC-IP-HOSNAME.COM");

//CLOUDFLARE CONFIG DATA
        $email = "YOUR@EMAIL.COM"; # Cloudflare account email address here
        $API_TOKEN = "UPDATE WITH YOUR API TOKEN"; # Cloudflare API token here (this one CAN BE FOUND on zero trust dashboard URL) exemple: (https://one.dash.cloudflare.com/WILL-BE-HERE/gateway/locations )
        $AUTH_KEY = "UPDATE WITH YOUR auth TOKEN"; # Your Cloudflare global API AUTH key here, find it in PROFILE -> dashboard
        $LOCATION_ID =  "UPDATE WITH YOUR id"; # THIS id CAN BE FOUND in the return of the CURL COMMAND 1, it will located inside the id value above name value
		    $LOCATION_NAME =  "UPDATE WITH YOUR location name"; # The Cloudflare ZT Gateway location name CAN BE FOUND in the return of the CURL COMMAND 1, it will located inside the name value
      
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,
'https://api.cloudflare.com/client/v4/accounts/' . $API_TOKEN . '/gateway/locations/' . $LOCATION_ID);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"client_default\": false,\n  \"ecs_support\": false,\n  \"name\": \"Kids\",\n  \"networks\":[{\"network\":
\"".$ip."/32\"}]\n}");

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-Auth-Key: ' . $AUTH_KEY;
$headers[] = 'X-Auth-Email: ' . $email;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
echo $ip . " SUCCESS UPDATED!"
?>
