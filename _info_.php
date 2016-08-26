<?php
$mod_name="kismet";
$mod_version="1.3";
$mod_path="/usr/share/fruitywifi/www/modules/$mod_name";
$mod_logs="$log_path/$mod_name.log"; 
$mod_logs_history="$mod_path/includes/logs";
$mod_panel="show";
$mod_isup="ps auxww | grep kismet_server | grep -v -e grep";
$mod_alias="Kismet";

# EXEC
$bin_sudo = "/usr/bin/sudo";
$bin_kismet_server = "/usr/bin/kismet_server";
$bin_gpsd = "/usr/sbin/gpsd";
$bin_killall = "/usr/bin/killall";
$bin_giskismet = "/usr/bin/giskismet";
$bin_rm = "/bin/rm";
?>
