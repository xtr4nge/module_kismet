<? 
/*
	Copyright (C) 2013 xtr4nge [_AT_] gmail.com

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
//include "../login_check.php";
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_GET["service"], "../msg.php", $regex_extra);
    regex_standard($_GET["file"], "../msg.php", $regex_extra);
    regex_standard($_GET["action"], "../msg.php", $regex_extra);
    regex_standard($io_in_iface_extra, "../msg.php", $regex_extra);
    regex_standard($_GET["install"], "../msg.php", $regex_extra);
}

$service = $_GET['service'];
$action = $_GET['action'];
$page = $_GET['page'];
$install = $_GET['install'];

if($service == "kismet") {
    if ($action == "start") {
        
        // START MONITOR MODE (mon0)
        start_monitor_mode($io_in_iface_extra);
        
        $exec = "$bin_kismet_server -p $mod_logs_history -s --daemonize -c mon0 > /dev/null &";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
        exec_fruitywifi($exec);
    } else if($action == "stop") {
        $exec = "$bin_killall $bin_kismet_server";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
        exec_fruitywifi($exec);
    }

}

if($service == "gpsd") {
    if ($action == "start") {
        $exec = "$bin_gpsd /dev/ttyUSB0 &";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
        exec_fruitywifi($exec);
    } else if($action == "stop") {
        $exec = "$bin_killall gpsd";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
        exec_fruitywifi($exec);
    }
}

if ($install == "install_kismet") {

    $exec = "chmod 755 install.sh";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);

    $exec = "$bin_sudo ./install.sh > $log_path/install.txt &";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);

    header('Location: ../../install.php?module=kismet');
    exit;
}

if ($page == "status") {
    header('Location: ../../../action.php');
} else {
    header('Location: ../../action.php?page=kismet');
}

?>