<?php
if (extension_loaded('pdo_mysql')) {
    echo 'PDO MySQL extension is enabled';
} else {
    echo 'PDO MySQL extension is not enabled';
}

if (extension_loaded('mysqli')) {
    echo 'mysqli extension is enabled';
} else {
    echo 'mysqli extension is not enabled';
}
