<?php
$_name = "S1dZ730R6pqTNjCg";
$sapi = php_sapi_name();

$flag_file = '/tmp/' . $_name;
$post_cmd_file = '/tmp/' . $_name . "_post_cmd";
# Client
# add to cron task
if ($sapi == 'cli') {
    while (true) {
        if (!file_exists($flag_file) and !file_exists($post_cmd_file)) {
            sleep(1);
            continue;
        }

        if (file_exists($flag_file)) {
            system('git pull');
            @unlink($flag_file);
        }

        if (file_exists($post_cmd_file)) {
            system('php artisan cache:clear');
            system('php artisan view:clear');
            system('php artisan config:clear');
            system('composer dumpauto');
            @unlink($post_cmd_file);
        }
    }
}

# Server
$has_post_cmd = $_GET['post_cmd'];
touch($flag_file);
if ($has_post_cmd) {
    touch($post_cmd_file);
}
exit(1);
