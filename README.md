# pregex (Persian|Iranians|Farsi Regex)
***

### TODO: 
- Add travisCI for project
- Improve documentation
- Add badges

 ---
 
[![Build Status](https://travis-ci.org/sedhossein/pregex.svg?branch=master)](https://travis-ci.org/sedhossein/pregex)
[![Coverage Status](https://coveralls.io/repos/github/sedhossein/pregex/badge.svg?branch=master)](https://coveralls.io/github/sedhossein/pregex?branch=master)
 
This Lib Contain The list of some Persian/iranian Regex's in just one library.



1. Methods : 

```php
    public static function is_persian_number(string $number): bool
```

```php
    public static function is_persian_text(string $string): bool
```

```php
    public function is_valid_email(string $email): bool
```

```php
    public function is_mobile_number(string $number): bool
```

```php
    public function is_valid_sheba($value): bool
```

```php
    public function is_melli_code($value): bool
```

```php
    public function is_card_number($value): bool
```

```php
    public function is_postal_card($value): bool
```
