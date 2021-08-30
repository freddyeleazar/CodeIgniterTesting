<?php 
class Upload extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('upload/upload_form', array('error' => ' '));
	}

	public function do_upload()
	{
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        $userFileCount = count($_FILES['userFiles']['name']);

		$this->load->library('email');

         $email_config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => 'tucorreo@gmail.com',
            'smtp_pass' => 'tucontraseña',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1',
            'newline' => "\r\n",
            'send_multipart' => FALSE
        );
        $this->email->initialize($email_config);

		$this->email->from('freddyeleazar@gmail.com', 'Freddy');
		$this->email->to('freddyeleazar@gmail.com');
		$this->email->cc('freddyeleazar@gmail.com');
		$this->email->bcc('freddyeleazar@hotmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

        for ($i=0; $i < $userFileCount; $i++) { 
			$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
			$this->upload->do_upload('userFile');
		
			$this->email->attach($this->upload->data('full_path'));
    	}

        if($this->email->send())
        {
            echo "Your Mail send";
        }
        else
        {
            show_error($this->email->print_debugger());
            exit();
        }

	}
}

 ?>