<?php
class Model_users extends CI_Model
{
    public function __construct()
    {
        // parent::__construct();
    }

    public function image_resize($image_path){
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $image_path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 300;
		$config['height']       = 300;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
		// $this->image_lib->crop();
	}

	public function do_upload($file_input, $file_name, $upload_path, $file_type = "gif|jpg|png|jpeg|bmp|pdf|xls|xlsx|doc|docx")
    {
		if (!empty($_FILES[$file_input])) {
			$this->load->library('upload');
			$config = array(
			'upload_path' => $upload_path,
			'allowed_types' => $file_type,
			'overwrite' => TRUE,
			'max_size' => "94096000", // Can be set to particular file size , here it is 94 MB(94096 Kb)
			'max_height' => "6400",
			'max_width' => "6400",	
			'file_name' =>	$file_name,
			);
			// $this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('upload-file'))
			{					
				$uploadData = $this->upload->data();
                // $data["image"] = $uploadData['file_name'];
                $this->session->set_flashdata('success', 'Successfully uploaded');
                $response['success'] = true;
                $response['messages'] = 'Succesfully upload scan';
			}
			else
			{
				$error = implode(';',array('error' => $this->upload->display_errors()));
                $this->session->set_flashdata('error', $error);
                $response['success'] = false;
	        	$response['messages'] = $error;

			}
		}
        else {
            
            $this->session->set_flashdata('error', 'No file selected');            
            $response['success'] = false;
            $response['messages'] = 'No file seleted for uploading image';
            // echo 'no file';
            return false;
            
        }

        echo json_encode($response);
		
	}

}
?>