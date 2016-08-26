<? 
/*
	Copyright (C) 2013-2016 xtr4nge [_AT_] gmail.com

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
?>
<?
include "../../../login_check.php";
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_GET["file"], "../msg.php", $regex_extra);
    regex_standard($_GET["action"], "../msg.php", $regex_extra);
}

$file = $_GET["file"];
$action = $_GET["action"];

if ($file == "all") {
	$logs = glob($mod_path . '/includes/logs/*.netxml');
	
    for ($i = 0; $i < count($logs); $i++) {
		//$exec = "$bin_giskismet --database $mod_logs_history/wireless.dbl -x $mod_logs_history/*.netxml";
		$exec = "$bin_giskismet --database $mod_logs_history/wireless.dbl -x " . $logs[$i];
		exec_fruitywifi($exec);
	}
    $exec = "$bin_giskismet --database $mod_logs_history/wireless.dbl -q 'select * from wireless' -o $mod_logs_history/output_all.kml";
    exec_fruitywifi($exec);
} else {
    if ($action == "delete") {
        $exec = "$bin_rm $mod_logs_history/$file.netxml";
        exec_fruitywifi($exec);
        $exec = "$bin_rm $mod_logs_history/$file.pcapdump";
        exec_fruitywifi($exec);
        $exec = "$bin_rm $mod_logs_history/$file.alert";
        exec_fruitywifi($exec);
        $exec = "$bin_rm $mod_logs_history/$file.gpsxml";
        exec_fruitywifi($exec);
        $exec = "$bin_rm $mod_logs_history/$file.nettxt";
        exec_fruitywifi($exec);
        $exec = "$bin_rm $mod_logs_history/$file.kml";
        exec_fruitywifi($exec);
    } else {
        $exec = "$bin_rm $mod_logs_history/wireless.dbl";
        exec_fruitywifi($exec);
        $exec = "$bin_giskismet --database $mod_logs_history/wireless.dbl -x $mod_logs_history/$file.netxml";
		echo $exec . "<br>";
        exec_fruitywifi($exec);
        $exec = "$bin_giskismet --database $mod_logs_history/wireless.dbl -q 'select * from wireless' -o $mod_logs_history/output_$file.kml";
		echo $exec . "<br>";
        exec_fruitywifi($exec);
    }
}

header('Location: ../index.php');

?>