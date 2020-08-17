<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Sedhossein\Pregex\Pregex;

/**
 * Class PregexTest
 * @package Tests\Unit
 */
final class PregexTest extends TestCase
{
    // ============================== Persian Numbers ==============================

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
        return [["۱"], ["۲"], ["۳"], ["۴"], ["۵"], ["۶"], ["۷"], ["۸"], ["۹"], ["۰"], ["۱۲۳۴۵۶۷۸۹"]];
    }

    public function InvalidPersianNumbers(): array
    {
        return [[" "], ["asd"], ["2"], ["٤"], ["٥"], ["٦"]];
    }

    // ============================== Arabic Numbers ==============================

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
        return [[" "], ["asd"], ["1"], ["۴"], ["۵"], ["۶"]];
    }

    // ============================== Arabic or Persian Numbers ==============================

    /**
     * @dataProvider ValidPersianAndArabicNumbers
     */
    public function test_valid_persian_and_arabic_number(string $number)
    {
        $this->assertEquals(true, (new Pregex)->IsPersianOrArabicNumber($number));
    }

    public function ValidPersianAndArabicNumbers(): array
    {
        return [
            ["۱"], ["۲"], ["۳"], ["۴"], ["۵"], ["۶"], ["۷"], ["۸"], ["۹"], ["۰"], ["۱۰۲۳۴۵۶۷۸۹"], // persian
            ["١"], ["٢"], ["٣"], ["٤"], ["٥"], ["٦"], ["٧"], ["٨"], ["٩"], ["٠"], ["١٠٢٣٤٥٦٧٨٩"], // arabic
            ["٦۶"], ["۵٥"], ["٤۴"], ["۱٠۲۳۴۵۶۷۸۹١٠٢٣٤٥٦٧٨٩"],                                     // combined
        ];
    }

    /**
     * @dataProvider InvalidPersianAndArabicNumbers
     */
    public function test_invalid_persian_and_arabic_number(string $number)
    {
        $this->assertEquals(false, (new Pregex)->IsPersianOrArabicNumber($number));
    }

    public function InvalidPersianAndArabicNumbers(): array
    {
        return [[" "], ["asd"], ["2"], ["٤"], ["٥"], ["٦"]];
    }


    /**
     * @dataProvider valid_persian_texts
     */
    public function test_valid_persian_text($sample_string)
    {
        $this->assertEquals(1, \Tests\Unit\Pregex::is_persian_text($sample_string));
    }

    /**
     * @dataProvider invalid_persian_texts
     * @param $sample_string
     */
    public function test_invalid_persian_text($sample_string)
    {
        $this->assertEquals(0, Pregex::is_persian_text($sample_string));
    }

    /**
     * @return array
     */
    public function valid_persian_texts()
    {
        return [
            ['بسم الله'],
            ['تست با فاصله و نیم‌فاصله '],
            ['تست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟'],
            ['۰۱۲۳۴۵۶۷۸۹ اعدادی فارسی اند'],
            ['٠١٢٣٤٥٦٧٨٩اعدادی عربی-فارسی اند'],
            ['قطعاً همه مئمنیم درّ گران بهاییْ هستندُ جهتِ تستیـ بهتر'],
            ['آمار اختلاص چندین٪ کم شده'],
            ['حروفی همچون ٪هٔيأؤئء'],
            ['ویرگول ها ٪هٔيأؤئء٫٬همراهی '],
            [' + = ! ? /\ , $ '],
            ['گچپژ'],
        ];
    }

    /**
     * @return array
     */
    public function invalid_persian_texts()
    {
        return [
            ['persian'],
            ['تست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ab یالا؟'],
            ['qwتست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟'],
            ['qwتست، قواعدی: و نگارشی پشت ژرفای ثبت.دست‌؛ یالا؟ew'],
            ['1234 اعدادی فارسی اند'],
            ['٠56اعدادی عربی-فارسی اند'],
        ];
    }


    /**
     * testing persian and arabic numbers
     */
    public function test_is_persian_number()
    {
        $falsy_strings = [
            '٢٣٤٥٦٧٨٩ ٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦٧٨٩,٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦٧٨٩.٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦12٧٨٩',
            '٢٣٤٥٦٧٨٩qw',
            'as٢٣٤٥٦٧٨٩',
            '٢٣٤٥٦0٧٨٩',
        ];
        foreach ($falsy_strings as $string)
            $this->assertEquals(Pregex::is_persian_number($string), 0);


        $true_strings = [
            '۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰۱۲۶۷۹۰',
            '۱۲۶۷',
        ];
        foreach ($true_strings as $string)
            $this->assertEquals(Pregex::is_persian_number($string), 1);
    }
}
