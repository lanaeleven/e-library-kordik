<?php
namespace App\Enums;
class Category
{
    const KEDOKTERAN = 1;
    const KEPERAWATAN = 2;
    const FARMASI = 3;

    public static function all()
    {
        return [
            self::KEDOKTERAN => 'Kedokteran',
            self::KEPERAWATAN => 'Keperawatan',
            self::FARMASI => 'Farmasi',
        ];
    }

    public static function name($value)
    {
        return isset(self::all()[$value])
            ? self::all()[$value]
            : 'Tidak diketahui';
    }
}