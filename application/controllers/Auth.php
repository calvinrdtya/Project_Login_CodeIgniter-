<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {   
        if ($this->session->userdata('email')) {
            redirect('user'); 
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false ){
        $data['title'] = 'Login Page';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
    } else {
        //validasinya success
        $this->_login();
    }
}
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

         //usernya ada
    if($user) {
        //jika usernya aktif  
        if($user['is_active'] == 1) {
            //cek password
            if(password_verify($password,$user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
              
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong password!</div>');
                redirect('auth');
            }
            
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This email has not been activated!</div>');
                redirect('auth');
            }

            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email is not registered!</div>');
                redirect('auth'); 

            }
}
  
    public function registration() 
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email','Email', 'required|max_length[30]|xss_clean|valid_email|is_unique[user.email]',
        ['is_unique' => 'This email has already registered!']);
        
        
        $this->form_validation->set_rules('password1', 'Password', 'required|max_length[30]|xss_clean','password2',
        [
            'matches' => 'Password dont match!', 
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|max_length[30]|xss_clean', 'password1');
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name'  => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message',' <div class="alert alert-success" role="alert">
            Congratulation! your account has been created. Please Login</div>');
            redirect('auth');                
        }
    }
    // public function logout()
    // {
    //     $this->session->unset_userdata('email');
    //     $this->session->unset_userdata('role_id');
    //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //     You Have been Logout!!</div>');
    //     redirect('auth'); 
    // }
    // public function hapus_data($id)
    //     {
    //         $data['subMenu'] = $this->subMenu->getSubMenu($id);
    //         $this->subMenu->hapus_data($id, $data);
    //         $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
    //         Successfully deleted</div>');  
    //         redirect('menu/submenu');
    //     }
    }
    