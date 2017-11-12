<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-11-12
 * Time: 下午3:02
 */
declare(strict_types=1);//开启强类型模式

class IndexModel extends Model
{
    public static function plus(int $a, int $b): int
    {
        return $a + $b;
    }
}