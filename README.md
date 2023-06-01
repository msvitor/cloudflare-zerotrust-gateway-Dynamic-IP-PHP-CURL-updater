# cloudflare-zerotrust-gateway-Dynamic-IP-PHP-CURL-updater
Automatically sync your Cloudflare Zero Trust Gateway location with the IP address of a hostname (No-IP, etc) using php+curl

How setup:

Firts thing to configure is get the proper respose for this curl command, WITH IT YOU WILL GET THE ID OF THE LOCATION
CURL COMMAND 1:  

curl --request GET \
  --url https://api.cloudflare.com/client/v4/accounts/PUT-HERE-THE-API-TOKEN/gateway/locations \ // put your Cloudflare API token here (this one CAN BE FOUND on zero trust dashboard URL) exemple: (https://one.dash.cloudflare.com/WILL-BE-HERE/gateway/locations )
  --header 'Content-Type: application/json' \
  --header 'X-Auth-Key: ' \    // PUT HERE Your Cloudflare global API AUTH key here, find it in PROFILE -> dashboard
  --header 'X-Auth-Email: my@email.com' // put your email here

*/
