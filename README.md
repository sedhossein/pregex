## Pregex: Claim any Persian|Iranian|Farsi Regular Expressions that you need
 
[![Build Status](https://travis-ci.org/sedhossein/pregex.svg?branch=master)](https://travis-ci.org/sedhossein/pregex)
[![Coverage Status](https://coveralls.io/repos/github/sedhossein/pregex/badge.svg?branch=master)](https://coveralls.io/github/sedhossein/pregex?branch=master)
[![Version](https://poser.pugx.org/sedhossein/pregex/version)](https://packagist.org/packages/sedhossein/pregex)
[![Total Downloads](https://poser.pugx.org/sedhossein/pregex/downloads)](https://packagist.org/packages/sedhossein/pregex)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sedhossein/pregex/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sedhossein/pregex/?branch=master)
[![License](https://poser.pugx.org/sedhossein/pregex/license)](//packagist.org/packages/sedhossein/pregex)


## Quick Access
- [Introduction](#introduction)
- [Requirements](#requirements)
- [How to use](#how-to-use)
    -  [List of methods](#list-of-methods)
- [Installation](#how-to-install)
- [TODO list](#todo-list)
- [License](#license)

### Introduction
If you having a Persian/Iranian project and need to validate your inputs this light library can help you. 
Pregex try to make a complete collection of Persian/Iranian validations to make it easy for you. 
Please kindly feeling free to get in touch with me for any idea you have, or open issue/PR to any bug reporting/fixing.

### Requirements
- composer
- PHP 7.2 >=

### How to use
Pregex prepared the bellow methods list to give you all you need for your validations.

```php
use Sedhossein\Pregex\Pregex;

$false = (new Pregex)->IsPersianOrArabicNumber("123456"); // False, cause `123456` are english numbers
$true = (new Pregex)->IsPersianOrArabicNumber("۱۲۳۴۵۶");  // True, cause `123456` are persian numbers
```
You can see some more examples in `./examples/index.php`


#### list of methods
```php
function IsPersianNumber(string $number): bool;
```
`IsPersianNumber` just validate persian alphabets(not arabic)

---
```php
function IsArabicNumber(string $number): bool;
```
`IsArabicNumber` just validate arabic alphabets(not persian)

---
```php
function IsPersianOrArabicNumber(string $number): bool;
```
`IsPersianOrArabicNumber` validate both Arabic and Persian alphabets. It can be useful when you need just Persian texts
 and user keyboards maybe having different languages(iPhone keyboards, android keyboards or non-standard keyboards)

---
```php
function IsEmail(string $email): bool;
```
`IsEmail` validate emails! Just for getting Pregex more complete for our mission ;))

---
```php
function IsCellphone(string $number): bool;
```
`IsCellphone` validate persian cellphone numbers. Valid inputs can begin with `+98{..}`, `98{..}`, `09{..}`, `9{..}`

---
```php
function IsIban(string $value): bool;
```
`IsIban` or also `Sheba` validate Iranian bank Ibans

---
```php
function IsNationalCode(string $value): bool;
```
`IsNationalCode` or also `Melli Code!` validate Iranian national codes

---
```php
function IsCardNumber(string $value): bool;
```
`IsCardNumber` validate Iranian bank card numbers

---
```php
function IsCardNumber(string $value): bool;
```
`IsCardNumber` validate Iranian bank card numbers

---
```php
function IsPostalCode(string $value): bool;
```
`IsPostalCode` validate Iranian postal code numbers

---
```php
function IsPersianText(string $value): bool;
```
`IsPersianText` validate Iranian and some Arabic alphabets with some held in common writing signs.

### How to install
Install [Composer](https://getcomposer.org) and run following command in your project's root directory:

```bash
composer require sedhossein/pregex
```


### TODO list: 
- [ ] Comparing with other libraries to add more features

### license
Pregex is initially created by [Sedhossein](https://sedhossein.dev) and released under the [MIT License](http://opensource.org/licenses/mit-license.php).

