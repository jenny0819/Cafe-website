<?php
include 'Session.php';
include('db_conn.php'); //db connection
include 'inc.php';
$mysql = new Mysql();
if (isset($_POST['insertstaff'])) {
    if ($_POST['insertstaff'] == 'update') {
        $input = $_POST;
        $data['name'] = $input['staff_name'];
        $data['position'] = $input['staff_position'];
        $data['branch'] = $input['staff_branch'];
        if (empty($input['staff_list_id'])) exit("Please input ID");
        if (empty($input['staff_name'])) exit("Please input Name");
        if (empty($input['staff_position'])) exit("Please input Position");
        if (empty($input['staff_branch'])) exit("Please input Branch");
        $res = $mysql->query_update('update staff_list set name = "' . $input['staff_name'] . '", position = "' . $input['staff_position'] . '", branch = "' . $input['staff_branch'] . '" where id = "' . $input['staff_list_id'] . '"');
        if ($res) {
            exit("1");
        } else {
            exit("Internet is unavailable, please try it later");
        }
    } else {
        $input = $_POST;
        $data['name'] = $input['staff_name'];
        $data['position'] = $input['staff_position'];
        $data['branch'] = $input['staff_branch'];
        if (empty($input['staff_name'])) exit("Please input Name");
        if (empty($input['staff_position'])) exit("Please input Position");
        if (empty($input['staff_branch'])) exit("Please input Branch");
        $res_add = $mysql->query_insert('staff_list', $data);
        if ($res_add) {
            exit("1");
        } else {
            exit("The adding is fail");
        }
    }
}
?>
