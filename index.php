<?php

$base_url='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['REQUEST_URI'].'?');
echo $base_url;

echo '<script type="text/javascript">';
echo 'localStorage.setItem("server", "' . $base_url . '")';
echo '</script>';

header('Location: /mars-rover/frontend/build/index.html');
exit;