<?php

function back() 
{
    if (isset($_SESSION['redirect']['previous'])) {
        return header("Location: ". $_SESSION['redirect']['previous']);
    }
}