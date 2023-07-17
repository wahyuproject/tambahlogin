<?php
class model_adminlog extends CI_Model{

    function cek_login($where){
        return $this->db->get_where('akun', $where);
    }
}
?>