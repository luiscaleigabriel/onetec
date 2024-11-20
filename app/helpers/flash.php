<?php

use app\support\Flash;

function flash(string $index, string $class = '')
{
    $message = Flash::get($index);

    return "<div class='{$class}'>{$message}</div>";
}
