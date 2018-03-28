<?php
//CẤU HÌNH TÀI KHOẢN (Configure account)
define('EMAIL_BUSINESS','haidangdhct24@gmail.com');//Email Bảo kim
define('MERCHANT_ID','30591');                // Mã website tích hợp
define('SECURE_PASS','5ac982bbd8dcff2c');   // Mật khẩu
// Cấu hình tài khoản tích hợp
define('API_USER','dreamcometrue');  //API USER
define('API_PWD','h1c1u0p510IS9CH09FZ43Wolm3Ts8');       //API PASSWORD
define('PRIVATE_KEY_BAOKIM','-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC8N0+Mu7wGqJlH
E6MGUT5pBd1PPAQ49eD3sgaPAlppRsBBxuD8bqy/hRjychj/7SmgnOEKAAcfxEqk
2J7UiQqPL14L5qNAvunvTnfnj8vh9wvjzA0GiWnZhv/m3n4XPLVnfzqb/SLrQMdl
irHoNMe44HcP2Leu/g2BDlxCZ+2v/95yA+/WYI6pe7Lkm2xHIz9FFDVQtFV3qyoG
GwJME0FWbyX12gA1Mrt7HC2IfrVY/ELInglYlI7RoyaTcBlenPKxr4+4t1vCOjZ0
5TACRYF4oj9TlRVa0bkIZoR1fE05ELh/NbRbQrBoxXHxXI0o3oP8WrFrZdghbcE2
HMswKJ97AgMBAAECggEAREqBV5vqbjQQYWSzmyAxV+Pj19L76Tr1pIn4rTz6VwZv
za3+hjkV/uupEJbrkTiZCQjC8mDuNM2BE+zxPEZ5CVjzc7f8dgqPUOAUy3U2UcfU
jZPFCiEjweSkxzzlXUMOwv2740tmtxsq/iHjyVAVQ3RWXu6QPzM47SGrwgB5kojR
/a8c7RWxfD+nBEs5QU88Ep8gAXStDsknwLI+kRmq45auaLEwAUtiJpnZcXCtqGQt
RTKUoV9+oWY7oGJs6pG+j+T0spf28h8ePVA+2btTNRpNKuIW8q+hDRsqHCDNxKVR
hA/iF8LLLL09/2uaMGG3njw5H39ajFClEDkjYcfdWQKBgQDdxgcdKPU3FrLeE106
gcBOAv8BFxr4Hon/MtLOISx1EDoep0StIA4KWmV9myGj2ZSSERYUN40rAgemw7iD
1Ay+nw91yKzotSs89T65clXjKLh99YwAkn7uu9pLfZX3iQJAAHdFRpglNXAMhhY6
SwTUDEuXHIiFOFntwYp6lC9sjQKBgQDZQ3jZZKWGbUDgvxbW6aa1gm2KmoFnu3DJ
DUnIlMqc+jHG/PCW6af0XEJffibJP2SzeAv4OuXSc8bPT2jkxxIc6JyV1dnsEYaO
p3e837rxJoCaVBtMefazz+Yi3O6t6Ju84BhAVuYMCjbpBhoc3ZJJ2JzfrjZNf7Mf
nTMS9xTuJwKBgQCF5xVQg/RbCLeC4so9ky4bbC+v5tV/zmCf1330u47uN5f//hq3
NU2E7sOsrUgIeEz+TJa6KjhwKU+ZXz8/SX9QcRWSllHgR9MNgT4YFnLJL0MFuoaH
qew+FOpe/jrYNL9JCX76Mv+WJ8e5qBQvqjAGIE5btPyxAy85IMyN6n8f2QKBgHMQ
le9kq3mPYT3mVl1J753Pzt4KSCC9F9WTMRGHI+uRYk2F5pG2e9oiBpD2ieoppdaa
7JPx9YfJA3EGGIKZn9EprMx6LukkuwPQU8z3HNXc011oz/Bn462FnNe39LysJdcZ
RB7HJx0XR8+QCMJi4rgzfZnFdUMEL8S9h7AypaYfAoGAf9nim2TBpCb5O+GjLFxV
h2EMaNedvNAmYVKj+NFtxtHUjTmbyZfJIY+DhUJ4KlghFJvtnpdc4bzl0KjKWELM
/P6IbXp0cmq9J3iiW+7FsvDyqwcHb8oxv+Le5EysuiSvO72BJPbd8pX5Z9Mgx0KF
w3vQZJRNFvQJx3gmnzb6NzU=
-----END PRIVATE KEY-----');

define('BAOKIM_API_SELLER_INFO','/payment/rest/payment_pro_api/get_seller_info');
define('BAOKIM_API_PAY_BY_CARD','/payment/rest/payment_pro_api/pay_by_card');
define('BAOKIM_API_PAYMENT','/payment/order/version11');

define('BAOKIM_URL','https://www.baokim.vn');
//define('BAOKIM_URL','http://baokim.dev');
// define('BAOKIM_URL','http://kiemthu.baokim.vn');
//Phương thức thanh toán bằng thẻ nội địa
define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
//Phương thức thanh toán bằng thẻ tín dụng quốc tế
define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
//Dịch vụ chuyển khoản online của các ngân hàng
define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
//Dịch vụ chuyển khoản ATM
define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);
?>