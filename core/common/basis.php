<?php

/* 打印调试
 *
 * @return mix
 */
function var_d($var)
{
    if (is_bool($var)) {
        var_dump($var);
    } else if (is_null($var)) {
        var_dump(null);
    } else {
        echo "<pre style='background:#f5f5f5'>" .print_r($var, true). "</pre>";
    }
}
?>
