<?php

return array(
 
    'driver' => 'smtp',
    'host' => 'mail.chronosh.com',
    'port' => 25,
    'from' => array('address' => 'cariperkakas@chronosh.com', 'name' => 'Cari perkakas'),
    //'encryption' => 'ssl',
    'username' => 'cariperkakas@chronosh.com',
    'password' => 'cariperkakas',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
 
);