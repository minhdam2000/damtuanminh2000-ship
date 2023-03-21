#note###

pass of proxy private key: pass_Proxy_Key
c
#Create CA

openssl genrsa -passout 'bkcs' -out ca.key 2048
openssl req -new -x509 -days 3650 -key ca.key -out ca.crt

#Gen BKCS CA Certificate 
openssl genrsa -out ca.key 2048 
openssl req -new -x509 -days 36500  -subj "/C=VN/CN=BKCS CA/O=BKCS" -key ca.key -out ca.crt

#Gen dascam.com certificate
openssl req -new -utf8 -nameopt multiline,utf8 -subj "/C=VN/CN=daskms.com/O=BKCS" -newkey rsa:2048 -passout pass:'pass_Server_Key' -keyout server.key -out server.csr
openssl x509 -req -days 36500 -in server.csr -CA ca.crt -CAkey ca.key -CAcreateserial -CAserial ca.seq -out server.crt
cat server.crt server.key > server.pem


//Config apache https 




#Specify BKCS Proxy

openssl req -new -utf8 -nameopt multiline,utf8 -subj "/C=VN/CN=BKCS Secure Proxy/O=BKCS" -newkey rsa:2048 -passout pass:'pass_Proxy_Key' -keyout client.key -out client.csr

#Sign
openssl x509 -req -days 36500 -in client.csr -CA ca.crt -CAkey ca.key -CAcreateserial -CAserial ca.seq -out client.crt


#Start ssl mode apache 2
sudo a2enmod ssl

//Get public key
openssl rsa -in client.key -passin pass:'pass_Proxy_Key' -outform PEM -pubout -out public.pem
