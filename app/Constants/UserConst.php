<?php

namespace App\Constants;

class UserConst
{
    const ADMIN = 'Admin';

    const STUDENT = 'Siswa';



    public static function getAccessTypes()
    {
        return [
            self::ADMIN => 'Admin',
            self::STUDENT => 'Siswa',
        ];
    }
}

