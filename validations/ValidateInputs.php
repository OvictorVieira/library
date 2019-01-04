<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 26/06/18
 * Time: 15:56
 */

class ValidateInputs
{
    /**
     * @param $array
     * @return bool
     */
    public function validadeInput($array)
    {

        foreach ($array as $key => $item) {

            if(!isset($item) || empty($item)) {
                return false;
            }
        }

        return true;
    }
}