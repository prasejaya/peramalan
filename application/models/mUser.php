<?php
class mUser extends CI_Model {

	public $table = "user";

	function cek($username,$password){
		$this->db->where("username",$username);
		$this->db->where("password",$password);
		return $this->db->get("user");
	}

	function semua(){
		return $this->db->get("user");

	}

	function getLogin($usr,$psw){
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));; 
		$cek = $this->db->get_where('user',array('username'=>$u,'password'=>$p));
		if (count($cek->result()) > 0) {
            foreach ($cek_->result() as $qck) {
                foreach ($q_cek_login->result() as $qad) {
                    $sess_data['username'] = $qad->username;
                    $sess_data['userid'] = $qad->userid;
                    $sess_data['nama'] = $qad->nama;
                    $this->session->set_userdata($sess_data);
                }
                redirect('dashboard');
            }
        } else {
            $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
            header('location:' . base_url() . 'login');
        }
    }

    function update($id, $info) {
        $this->db->where("userid", $id);
        $this->db->update("user", $info);
    }

    function simpan($info) {
        $this->db->insert("user", $info);
    }

    function hapus($kode) {
        $this->db->where("userid", $kode);
        $this->db->delete("user");
    }
}