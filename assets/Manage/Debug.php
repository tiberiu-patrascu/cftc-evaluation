<?php

function debug($var = null, $title = null)
{
    echo "<div class='debug'>";
    echo "<pre>";
    echo '<h2>' . $title . '</h2>';
    echo "<h3>" . gettype($var) . "</h3>";
    echo var_export($var, true);
    echo "</pre>";
    echo "</div>";
}
