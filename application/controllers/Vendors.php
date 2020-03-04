<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Vendors extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Mdl_vendor');
    }
	public function register()
	{

        $template_data=array(
            'main_content'=>'vendors/register',
            'success'=>$this->session->flashdata('success'),
            'error'=>$this->session->flashdata('error')
        );
		$this->load->view('templates/beforelogin/index',$template_data);
    }
    public function login(){
        $template_data=array(
            'main_content'=>'vendors/login',
            'success'=>$this->session->flashdata('success'),
            'error'=>$this->session->flashdata('error')
        );
		$this->load->view('templates/beforelogin/index',$template_data);
    }
    public function authenticate(){
        if($this->input->method() === 'post')
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            if ($this->form_validation->run() == FALSE)
            {
                    //authentication error
                    $template_data=array(
                        'main_content'=>'vendors/authenticate',
                    );
                    $this->load->view('templates/beforelogin/index',$template_data);
                    
            }
            else{
                //check the username and password
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $vendor=$this->Mdl_vendor->getRecord(array('email'=>$email,'password'=>md5($password)));
                if(empty($vendor)){
                    //
                    $this->session->set_flashdata('error','Invlid Email or Password');
                    redirect('vendors/login');
                }else{
                    //set the session
                    $this->session->set_userdata('vendor',$vendor);
                    redirect('vendors/dashboard');
                }
            }
        }
        else{
            redirect('vendors/login');
        }
    }
    public function dashboard(){
       
        $vendor=$this->session->userdata('vendor');
        if(empty($vendor))
            redirect('vendors/login');
        $template_data=array(
            'main_content'=>'vendors/dashboard',
        );
        $this->load->view('templates/vendor/index',$template_data);
    }
    public function changepassword(){
        $vendor=$this->session->userdata('vendor');
        if(empty($vendor))
            redirect('vendors/login');
        
        $template_data=array(
            'main_content'=>'vendors/changepassword',
            'error'=>$this->session->flashdata('error'),
            'success'=>$this->session->flashdata('success'),
        );
        $this->load->view('templates/vendor/index',$template_data);
    }
    public function updatepassword(){
        $vendor=$this->session->userdata('vendor');
        if(empty($vendor))
            redirect('vendors/login');
        if($this->input->method() === 'post')
        {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            if ($this->form_validation->run() == FALSE)
            {
                    $template_data=array(
                        'main_content'=>'vendors/changepassword',
                    );
                    $this->load->view('templates/beforelogin/index',$template_data);
                    
            }
            else
            {
                $password=$this->input->post('password');
                $updateData=array(
                    'password'=>md5($password)
                );
                $vendor=$this->session->userdata('vendor');
                $this->Mdl_vendor->updateRecord(array('id'=>$vendor['id']),$updateData);
                $this->session->set_flashdata('success',"Password has been updated sucessfully!");
                redirect('vendors/changepassword');
            }
        }
        else{
            redirect('vendors/login');
        }

    }
    public function logout(){
        $vendor=$this->session->userdata('vendor');
        if(empty($vendor))
            redirect('vendors/login');
        $this->session->unset_userdata('vendor');
        $this->session->set_flashdata('success','You have successfully logout!');
        redirect('vendors/login');
    }
    public function doRegister(){
        if($this->input->method() === 'post')
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('storename', 'Stote Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'trim|required|matches[password]');
            //$this->form_validation->set_rules('agree', 'You must agree to Terms', 'required');

            
            if ($this->form_validation->run() == FALSE)
            {
                    $template_data=array(
                        'main_content'=>'vendors/register',
                    );
                    $this->load->view('templates/beforelogin/index',$template_data);
                    
            }
            else
            {
                   // $this->load->view('formsuccess');
                   //process registration
                   //add the data into the registration
                   $firstname=$this->input->post('firstname');
                   $lastname=$this->input->post('lastname');
                   $email=$this->input->post('email');
                   $storename=$this->input->post('storename');
                   $password=$this->input->post('password');
                   $insertData=array(
                        'firstname'=>$firstname,
                        'lastname'=>$lastname,
                        'email'=>$email,
                        'storename'=>$storename,
                        'password'=>md5($password),
                        'created'=>date('Y-m-d h:i:s'),
                        'modified'=>date('Y-m-d h:i:s')
                   );
                   $vendor_id=$this->Mdl_vendor->create($insertData);
                   if($vendor_id){
                        //vendor register sucessfully
                        $this->session->set_flashdata('success','Vendor has been registered successfully!');
                        redirect('vendors/register');
                   }
                   else{
                        // error 
                        $this->session->set_flashdata('error','Email address is already in use!');
                        redirect('vendors/register');
                   }
            }
        }
        else
            redirect('vendors/register');
    }
}
