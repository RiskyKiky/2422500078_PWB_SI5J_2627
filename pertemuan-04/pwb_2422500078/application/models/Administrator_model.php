<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator_model extends CI_Model
{
    
    public function check_login($username, $password)
    {
        $admin = $this->db
            ->get_where('administrator', ['username' => $username])
            ->row_array();

        if ($admin && $admin['password'] === md5($password)) {
            return $admin;
        }
        return FALSE;
    }
}