<?php
/**
 * Created by PhpStorm.
 * User: zrj
 * Date: 17-11-12
 * Time: 下午1:50
 */
declare(strict_types=1);//开启强类型模式

class IndexController extends Controller
{
    public function index()
    {
        echo "<h2><center>PHP MVC Frame</center></h2>";
    }

    public function show(){
        echo IndexModel::plus(1,2);
    }
}