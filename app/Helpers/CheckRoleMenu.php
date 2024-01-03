<?php
/**
 * Kiểm tra hiển thị trên menu
 */
function checkRoleMenu($roles = []) {
    $userRole = session()->get('user')['role'];
    if ($userRole == 0) {
        return true;
    }
    if (count($roles) == 0 && $userRole == 0) {
        return true;
    }
    array_push($roles, 0);
    if (in_array($userRole, $roles)) {
        return true;
    }
    return false;
}