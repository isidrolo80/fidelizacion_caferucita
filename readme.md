# Caferucita Fidelity System

This a PHP - Codeigniter code for a fidelity system for any type of business. The main feature now is the Giftcard option which can be used as a wallet for the store. The wallet works with a QR code which the establishment reads and makes the corresponding charges to your account. 

If there's reason to believe the QR belongs to another person, the store clerk can check the ID to identify to the account owner. 

## Installation

/Application/config/database.php 

Change variables to connect to your own database

```php
'hostname' => '',
'username' => '',
'password' => '',
'database' => '',
```

### /application/config/config.php

change variables to your own

```php
$config['base_url'] = '';
$config['index_page'] = 'index.php';
$config['encryption_key'] = 'MyEncryptionKey';
$config['time_reference'] = date_default_timezone_set('America/Guayaquil');
```

### /application/controllers/vendedor.php

Change "from" and "bcc" to your own on the mailgun information

```php
->from('This is the name shown in the from section <hello@mycompany.com>')
->bcc('I want to bcc to this email')

```

### /application/controllers/Recoverpassword.php

Change to your own

```
->from('This is the name shown in the from section <hello@mycompany.com>')
->subject('Recupera tu contrasena')
```

### /application/libraries/Mailgun.php

Change the Mailgun API key and URL to your own
```
$url = "MYURL mailgun ";
curl_setopt($ch, CURLOPT_USERPWD, "api:" . "key-MYOWNKEY");  
```


If you don't have or don't want to use Mailgun, included there's a free alternative named phpMailer in the libraries section. 


### Run database dump
Located at /database/DumpFidelizacion.sql




## Usage

Once installed just go to your installation path and will work

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)