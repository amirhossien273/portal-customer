<?php

namespace App\Support;

final class MobileNumber
{
    public static function toEnglishDigits(?string $value): string
    {
        return strtr((string) $value, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);
    }

    public static function normalize(?string $value): ?string
    {
        $value = self::toEnglishDigits($value);

        $digits = preg_replace('/\D+/', '', $value) ?? '';

        if (str_starts_with($digits, '0098')) {
            $digits = '0'.substr($digits, 4);
        } elseif (str_starts_with($digits, '98') && strlen($digits) === 12) {
            $digits = '0'.substr($digits, 2);
        } elseif (strlen($digits) === 10 && str_starts_with($digits, '9')) {
            $digits = '0'.$digits;
        }

        return preg_match('/^09\d{9}$/', $digits) === 1 ? $digits : null;
    }

    /** @return list<string> */
    public static function databaseVariants(string $mobile): array
    {
        $national = substr($mobile, 1);
        $latin = [
            $mobile,
            $national,
            '98'.$national,
            '+98'.$national,
            '0098'.$national,
        ];
        $persian = array_map(fn (string $value) => strtr($value, [
            '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
            '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
        ]), $latin);
        $arabic = array_map(fn (string $value) => strtr($value, [
            '0' => '٠', '1' => '١', '2' => '٢', '3' => '٣', '4' => '٤',
            '5' => '٥', '6' => '٦', '7' => '٧', '8' => '٨', '9' => '٩',
        ]), $latin);

        return array_values(array_unique([...$latin, ...$persian, ...$arabic]));
    }

    public static function mask(string $mobile): string
    {
        return substr($mobile, 0, 4).' ••• '.substr($mobile, -4);
    }
}
