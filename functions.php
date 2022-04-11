<?php
    if(! function_exists('redirect')) {
        function redirect($url = '') {
            if(! empty($url)) {
                echo "<script>";
                echo "window.location.href = '".$url."';";
                echo "</script>";
                exit();
            }
        }
    }

    if(! function_exists('reload')) {
        function reload() {
            if(! empty($url)) {
                echo "<script>";
                echo "location.reload();";
                echo "</script>";
                exit();
            }
        }
    }

    if(! function_exists('managerRoles')) {
        function managerRoles($role = '') {
            global $conn;
            $return = false;
            if(! empty($role)) {
                if( (isset($_SESSION['admin_id'])) && (! empty($_SESSION['admin_id'])) ) {
                    $sql = "SELECT * FROM `admin` WHERE `admin_id`=".$_SESSION['admin_id'];
                    $result = $conn->query($sql);
                    $num_rows = $result->num_rows;
                    if(! empty($num_rows)) {
                        $row = $result->fetch_assoc();
                        $roles = json_decode($row['roles']);
                        if( (isset($roles)) && (is_array($roles)) && (in_array($role, $roles)) ) {
                            $return = true;
                        }
                    }
                }
            }

            return $return;
        }
    }
?>