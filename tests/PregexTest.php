<?php
declare(strict_types=1);

namespace Sedhossein\Pregex\Tests;

use PHPUnit\Framework\TestCase;
use Sedhossein\Pregex\Pregex;

final class PregexTest extends TestCase
{
    // ============================== Persian Numbers Validations ==============================

    /**
     * @dataProvider ValidPersianNumbers
     */
    public function test_valid_persian_number(string $number)
    {
        $this->assertEquals(true, (new Pregex)->IsPersianNumber($number));
    }

    /**
     * @dataProvider InvalidPersianNumbers
     */
    public function test_invalid_persian_number(string $number)
    {
        $this->assertEquals(false, (new Pregex)->IsPersianNumber($number));
    }

    public function ValidPersianNumbers(): array
    {
        return [
            ["۱"], ["۲"], ["۳"],
            ["۴"], ["۵"], ["۶"],
            ["۷"], ["۸"], ["۹"],
            ["۰"], ["۱۲۳۴۵۶۷۸۹"],
            ["۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰"],
            ["۱۲۶۷"]
        ];
    }

    public function InvalidPersianNumbers(): array
    {
        return [
            [" "], ["asd"], ["2"], ["٤"], ["٥"], ["٦"], [""],
            ["٢٣٤٥٦12٧٨٩"], ["٢٣٤٥٦٧٨٩ ٢٣٤٥٦٧٨٩"], ["٢٣٤٥٦٧٨٩qw"],
            ["٢٣٤٥٦٧٨٩.٢٣٤٥٦٧٨٩"], ["as٢٣٤٥٦٧٨٩"], ["٢٣٤٥٦0٧٨٩"],
            ["٢٣٤٥٦٧٨٩,٢٣٤٥٦٧٨٩"],
        ];
    }

    // ============================== Arabic Numbers Validations ==============================

    /**
     * @dataProvider ValidArabicNumbers
     */
    public function test_valid_arabic_number(string $number)
    {
        $this->assertEquals(true, (new Pregex)->IsArabicNumber($number));
    }

    /**
     * @dataProvider InvalidArabicNumbers
     * @param string $number
     */
    public function test_invalid_arabic_number(string $number)
    {
        $this->assertEquals(false, (new Pregex)->IsArabicNumber($number));
    }

    public function ValidArabicNumbers(): array
    {
        return [["١"], ["٢"], ["٣"], ["٤"], ["٥"], ["٦"], ["٧"], ["٨"], ["٩"], ["٠"], ["١٠٢٣٤٥٦٧٨٩"]];
    }

    public function InvalidArabicNumbers(): array
    {
        return [[" "], ["asd"], ["1"], ["۴"], ["۵"], ["۶"], [""]];
    }

    // ============================== Arabic or Persian Numbers Validations ==============================

    /**
     * @dataProvider ValidPersianAndArabicNumbers
     */
    public function test_valid_persian_and_arabic_number(string $number)
    {
        $this->assertEquals(true, (new Pregex)->IsPersianOrArabicNumber($number));
    }

    /**
     * @dataProvider InvalidPersianAndArabicNumbers
     */
    public function test_invalid_persian_and_arabic_number(string $number)
    {
        $this->assertEquals(false, (new Pregex)->IsPersianOrArabicNumber($number));
    }

    public function ValidPersianAndArabicNumbers(): array
    {
        return [
            ["۱"], ["۲"], ["۳"], ["۴"], ["۵"], ["۶"], ["۷"], ["۸"], ["۹"], ["۰"], ["۱۰۲۳۴۵۶۷۸۹"], // persian
            ["١"], ["٢"], ["٣"], ["٤"], ["٥"], ["٦"], ["٧"], ["٨"], ["٩"], ["٠"], ["١٠٢٣٤٥٦٧٨٩"], // arabic
            ["٦۶"], ["۵٥"], ["٤۴"], ["۱٠۲۳۴۵۶۷۸۹١٠٢٣٤٥٦٧٨٩"],                                     // combined
        ];
    }

    public function InvalidPersianAndArabicNumbers(): array
    {
        return [[" "], ["asd"], ["1"], ["123"], ["."], [""]];
    }

    // ============================== Email Validations ==============================

    /**
     * @dataProvider ValidEmails
     */
    public function test_valid_emails(string $email)
    {
        $this->assertEquals(true, (new Pregex)->IsEmail($email));
    }

    /**
     * @dataProvider InvalidEmails
     */
    public function test_invalid_emails(string $email)
    {
        $this->assertEquals(false, (new Pregex)->IsEmail($email));
    }

    public function ValidEmails(): array
    {
        return [
            ["test@sedhossein.dev"], ["test.test@sedhossein.dev"],
            ["test_test@sedhossein.dev"], ["test+test@sedhossein.dev"],
            ["t@sedhossein.dev"], ["test123@sedhossein.dev"],
            ["123test.123_test@sedhossein.dev"], ["test@t.io"],
            ["a@b.c"]
        ];
    }

    public function InvalidEmails(): array
    {
        return [
            ["test..test@sedhossein.dev"], ["@sedhossein.dev"], ["test@sedhossein"], [".@sedhossein.dev"],
            ["test@sedhossein@dev.ir"], ["test@sedhossein@dev.ir"], [""]
        ];
    }

    // ============================== Cellphone Validations ==============================

    /**
     * @dataProvider ValidCellphones
     */
    public function test_valid_cellphones(string $email)
    {
        $this->assertEquals(true, (new Pregex)->IsCellphone($email));
    }

    /**
     * @dataProvider InvalidCellphones
     */
    public function test_invalid_cellphones(string $email)
    {
        $this->assertEquals(false, (new Pregex)->IsCellphone($email));
    }

    public function ValidCellphones(): array
    {
        return [
            ["09123456789"], ["9123456789"],
            ["989123456789"], ["+989123456789"],
        ];
    }

    public function InvalidCellphones(): array
    {
        return [
            ["091234567899"], ["0909123456789"], ["++989123456789"],
            ["123456"], ["98989123456789"], [""]
        ];
    }

    // ============================== National Code Validations ==============================

    /**
     * @dataProvider ValidNationalCode
     */
    public function test_valid_national_codes(string $code)
    {
        $this->assertEquals(true, (new Pregex)->IsNationalCode($code));
    }

    /**
     * @dataProvider InvalidNationalCode
     */
    public function test_invalid_national_codes(string $code)
    {
        $this->assertEquals(false, (new Pregex)->IsNationalCode($code));
    }

    public function ValidNationalCode(): array
    {
        return [
            // TODO: this repo tested with personal national code,
            // but for security issues i ignore this test on open-source
        ];
    }

    public function InvalidNationalCode(): array
    {
        return [
            ["0000000000"], ["1111111111"], ["2222222222"],
            ["3333333333"], ["4444444444"], ["5555555555"],
            ["6666666666"], ["7777777777"], ["8888888888"],
            ["9999999999"], [""]
        ];
    }

    // ============================== IBan Validations ==============================

    /**
     * @dataProvider ValidIBan
     */
    public function test_valid_iban(string $code)
    {
        $this->assertEquals(true, (new Pregex)->IsIban($code));
    }

    /**
     * @dataProvider InvalidIBan
     */
    public function test_invalid_iban(string $code)
    {
        $this->assertEquals(false, (new Pregex)->IsIban($code));
    }

    public function ValidIBan(): array
    {
        return [
            ["IR_400700001000117676135001"], ["IR400700001000117676135001"]
        ];
    }

    public function InvalidIBan(): array
    {
        return [
            ["asd"], ["123"], ["000000000000000000000000"], [""]
        ];
    }

    // ============================== Card Validations ==============================

    /**
     * @dataProvider ValidCardNumber
     */
    public function test_valid_card(string $card)
    {
        $this->assertEquals(true, (new Pregex)->IsCardNumber($card));
    }

    /**
     * @dataProvider InvalidCardNumber
     */
    public function test_invalid_card(string $card)
    {
        $this->assertEquals(false, (new Pregex)->IsCardNumber($card));
    }

    public function ValidCardNumber(): array
    {
        return [
            ["5041721077783323"],
        ];
    }

    public function InvalidCardNumber(): array
    {
        return [
            ["5040721077783323"], ["0000000000000000"], ["000000000000000000000000"], [""],
            ["1111111111111111"], ["2222222222222222"], ["3333333333333333"],
            ["4444444444444444"], ["5555555555555555"], ["6666666666666666"],
            ["7777777777777777"], ["8888888888888888"], ["9999999999999999"],
            ["asd"], ["0123456789"], ["9999999999999999"],
        ];
    }

    // ============================== Card Validations ==============================

    /**
     * @dataProvider ValidPostalCode
     */
    public function test_valid_postal_code(string $code)
    {
        $this->assertEquals(true, (new Pregex)->IsPostalCode($code));
    }

    /**
     * @dataProvider InvalidPostalCode
     */
    public function test_invalid_postal_code(string $code)
    {
        $this->assertEquals(false, (new Pregex)->IsPostalCode($code));
    }

    public function ValidPostalCode(): array
    {
        return [
            ["0123456789"], ["12345-12345"],
        ];
    }

    public function InvalidPostalCode(): array
    {
        return [
            ["123456789"], ["00000--00000"], ["asd"], ["9999999999999999"],
        ];
    }

    // ============================== Persian text/alphabets validations ==============================

    /**
     * @dataProvider valid_persian_texts
     */
    public function test_valid_persian_text(string $string)
    {
        $this->assertEquals(true, (new Pregex)->IsPersianText($string));
    }

    /**
     * @dataProvider invalid_persian_texts
     */
    public function test_invalid_persian_text(string $string)
    {
        $this->assertEquals(false, (new Pregex)->IsPersianText($string));
    }

    public function valid_persian_texts(): array
    {
        return [
            ['گچپژ'],
            ['ەيىكًٍ'],
            ['بسم الله'],
            ['حروفی همچون ٪هٔيأؤئء'],
            ['تست با فاصله و نیم‌فاصله '],
            ['آمار اختلاص چندین٪ کم شده'],
            ['ویرگول ها ٪هٔيأؤئء٫٬همراهی '],
            ['۰۱۲۳۴۵۶۷۸۹ اعدادی فارسی اند'],
            ['ءآأؤإئابتثجحخدذرزسشصضطظعغفقلمنهوَُِّٕپچژکگھی'],
            ['قطعاً همه مئمنیم درّ گران بهاییْ هستندُ جهتِ تستیـ بهتر'],
            ['تست، قواعدی و نگارشی پشت ژرفای ثبت. آسمان دست‌؛ یالا؟'],
        ];
    }

    public function invalid_persian_texts(): array
    {
        return [
            ['persian finglish'],
            ['1234 اعدادی فارسی اند'],
            ['٠56اعدادی عربی-فارسی نیستند'],
            ['تست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ab یالا؟'],
            ['qwتست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟'],
            ['qwتست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟ew'],
        ];
    }

    // TODO: tests
}
