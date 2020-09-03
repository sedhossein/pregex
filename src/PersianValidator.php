<?php

namespace Sedhossein\Pregex;

interface PersianValidator
{
    public function IsPersianNumber(string $number): bool;

    public function IsArabicNumber(string $number): bool;

    public function IsPersianOrArabicNumber(string $number): bool;

    public function IsEmail(string $email): bool;

    public function IsCellphone(string $number): bool;

    public function IsIban(string $value): bool;

    public function IsNationalCode(string $value): bool;

    public function IsCardNumber(string $value): bool;

    public function IsPostalCode(string $value): bool;

    public function IsPersianText(string $value): bool;

    public function IsPersianName(string $name): bool;

    public function IsPersianAlphabet(string $chars): bool;

    public function IsWithoutPersianAlphabet(string $value): bool;

    public function IsWithoutNumber(string $value): bool;
}
