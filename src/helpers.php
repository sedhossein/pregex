<?php
/**
 * Created by PhpStorm.
 * User: sedhossein
 * Date: 11/21/2018
 * Time: 10:49 AM
 */

if (! function_exists('pregex')) {

    function pregex($str = null)
    {
        return \Sedhossein\Pregex\pregex::is_persian_text($str);
    }
}
