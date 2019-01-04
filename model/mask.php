<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 15/06/18
 * Time: 11:54
 */

function Mask($str, $mask = "%s%s%s.%s%s%s.%s%s%s-%s%s"){

    return  vsprintf($mask, str_split($str));
}