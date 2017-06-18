<?php

namespace App\Konohanaruto\Infrastructures\Common;

class PasswordSecure
{
    /**
     * 生成salt
     */
    public function gernerateSalt()
    {
        return dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
    }
    
    /**
     * 入库的password
     * @param string $nativePassword
     */
    public function getEncryptPassword($nativePassword, $salt)
    {
        $password = hash('sha256', $nativePassword . $salt);
        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }
        return $password;
    }
}