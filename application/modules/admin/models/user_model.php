<?php
class user_model extends CI_Model{
    protected $table = "tbl_user";
    protected $group = "tbl_group";
    
    public function __consruct()
    {
        parent::__construct();   
        if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] >= 2){
     	      redirect(base_url().'admin/login');
      	 }
    }
    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function check_login($name,$password){
        $this->db->where("user_name",$name);
        $this->db->where("password",md5($password));
        return $this->db->get($this->table)->row_array();
    }
    public function info_user($name){
        $this->db->where("user_name",$name);
        return $this->db->get($this->table)->row_array();
    }
    public function check_password($name,$pass){
        $this->db->where("user_name",$name);
        $this->db->where("password",md5($pass));
        return $this->db->get($this->table)->row_array();
    }
    public function change_password($data){
        $this->db->update($this->table,$data);
    }
    public function getGroup($id){
        $this->db->where('id',$id);
        return $this->db->get($this->group)->row_array();
    }
}

    
