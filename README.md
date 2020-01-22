## Multiple SMS/OTP Vendor

## In settings table
  In setting table add `msg91` or `nimbus`. This package currently support those.~

## Sending messages
    SMS::message('XXXXXXXXX', 'hello world');

    SMS::message(['XXXXXXXXX','XXXXXXXXXX'], 'hello world');


## Publish assets
    php artisan vendor:publish --extsalt-sms
