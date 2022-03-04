<?php

function pre_var_dump($data)
{
    if (is_array($data)) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    } else {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}

function pre_print_r($data)
{
    if (is_array($data)) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    } else {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}