<?php
require 'ACMECert.php';

use skoerfgen\ACMECert\ACMECert;


$ac=new ACMECert('https://acme-v02.api.letsencrypt.org/directory');

/*$key=$ac->generateRSAKey(2048);
file_put_contents('cert/account_key.pem',$key);

$ac->loadAccountKey(file_get_contents('cert/account_key.pem'));
$ret=$ac->register(true,'certificate@ww.alexsofonea.com');
print_r($ret);*/

$ac->loadAccountKey(file_get_contents('cert/account_key.pem'));

$domain_config=array(
  'wwdev.systems'=>array('challenge'=>'http-01','docroot'=>'../../cloud/vhost/wwdev.systems/')
);

$handler=function($opts){
  $fn=$opts['config']['docroot'].$opts['key'];
  $result = @mkdir(dirname($fn),0777,true);
  if ($result) {
      echo "Directory created successfully.";
  } else {
      echo "Failed to create directory.";
  }
  file_put_contents($fn,$opts['value']);
  echo $fn;
  /*return function($opts){
    unlink($opts['config']['docroot'].$opts['key']);
  };*/
};

$private_key=$ac->generateRSAKey(2048);

$fullchain=$ac->getCertificateChain($private_key,$domain_config,$handler);
file_put_contents('fullchain.pem',$fullchain);
file_put_contents('private_key.pem',$private_key);
?>