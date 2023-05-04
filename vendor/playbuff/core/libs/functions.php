<?php 

function redirect($location = false) {
    if ($location) {
        $redirect = $location;
    } else {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $redirect = isset($_SERVER["HTTP_REFERER"]);
        } else {
            $redirect = PATH;
        }
    }

    header("Location: $redirect");
    exit;
}

function debug($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function dataClear($string) {
    return htmlspecialchars(trim($string));
}

?>