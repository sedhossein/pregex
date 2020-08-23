# pregex: Find any Regular Expresion for Persian|Iranian|Farsi Guys
***

### TODO: 
- Add travisCI for project
- Improve documentation
- Add badges
- Documentation

 ---
 
[![Build Status](https://travis-ci.com/sedhossein/pregex.svg?branch=master)](https://travis-ci.com/sedhossein/pregex)
[![Coverage Status](https://coveralls.io/repos/github/sedhossein/pregex/badge.svg?branch=master)](https://coveralls.io/github/sedhossein/pregex?branch=master)
 
This Lib Contain The list of Persian/Farsi Regex's and validations in just one library.



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
