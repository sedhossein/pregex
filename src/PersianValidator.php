<?php

namespace Sedhossein\Pregex;

interface PersianValidator
{
    function IsPersianNumber(string $number): bool;

    function IsArabicNumber(string $number): bool;

    function IsPersianOrArabicNumber(string $number): bool;

    function IsEmail(string $email): bool;

    function IsCellphone(string $number): bool;

    function IsIban(string $value): bool;

    function IsNationalCode(string $value): bool;

    function IsCardNumber(string $value): bool;

    function IsPostalCode(string $value): bool;

    function IsPersianText(string $value): bool;

    // TODO:
    function IsPersianName(string $name): bool;

    function IsPersianAddress(string $address): bool;

    function IsPersianAlphabet(string $chars): bool;

    function IsNonPhone(string $value): bool;
}
