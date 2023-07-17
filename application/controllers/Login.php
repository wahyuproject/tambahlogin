<?php
class Login extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('model_adminlog');
      
    }
// menampilkan form login
   public function index(){
    $this->load->view('form_login');
   }
// aksi pada saat pengguna menekan tombol login
   public function login_aksi(){
    $user = $this->input->post('username', true);
    $pass = $this->input->post('password', true);

    // rule validation
    $this->form_validation->set_rules('username','Username', 'required');
    $this->form_validation->set_rules('password','Password', 'required');

    if ($this->form_validation->run() != FALSE) {
        $where = array(
            'username' => $user,
            'password' => $pass
        );

            $cekLogin = $this->model_adminlog->cek_login($where)->num_rows();

            if($cekLogin > 0){
                $sess_data = array(
                    'username' => $user,
                    'login' => 'Berhasil'
                );

                $this->session->set_userdata($sess_data);
                redirect(base_url('transfer'));

            }else{
                redirect(base_url('login'));
            }

    }else {
        $this->load->view('form_login');
    }
   }

// proses logout
   public function logout(){

    $this->session->sess_destroy();
    redirect(base_url('login'));

   }
}
?>
