## Description:

Client library for EasySlip

## Features:

<ul>
  <li>Verify Slip</li>
</ul>

## Example:

##### Verify Slip:

```php
$slip = new EasySlip('TEST');
$data = $slip->verifyByPayload('TEST');

print_r($data) // Out put same as https://developer.easyslip.com/document
```

```php
$slip = new EasySlip('TEST');
$data = $slip->verifyByImage('slip.jpg');

print_r($data) // Out put same as https://developer.easyslip.com/document
```
