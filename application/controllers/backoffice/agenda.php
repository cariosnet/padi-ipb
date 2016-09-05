<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {
	
	function Agenda(){
		parent::__construct();	

		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		$this->load->model('X_Agenda_Model');
		
		$data = array(
				'pageTitle' 	=> 'Agenda',
				'content'	 	=> 'back/agenda/agenda-list',
				'contentData'	=> array(
						'listData'		=> $this->X_Agenda_Model->getListDataNoLimit("1")
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
		$data = array(
				'pageTitle' 	=> 'Buat Agenda Baru',
				'content'	 	=> 'back/agenda/agenda-add',
				'contentData'	=> array(
						
				)
		);
				
		$this->load->view('back/layout', $data);
		
	}
	
	function submit(){
		$this->load->model('X_Agenda_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
				
			$data = array(
					'TITLE'		=> $this->input->post('title'),
					'DESC'		=> $this->input->post('desc'),
					'STATUS'	=> $this->input->post('status'),
					'TYPE'		=> "1",
					'DATE'		=> date("Y-m-d H:i:s", strtotime($this->input->post('x_date')." ".$this->input->post('x_time'))),
			);
			
			if($this->input->post('alias') != $this->input->post('alias_old'))
				$data['ALIAS']		= $this->_getAlias($this->input->post('alias'));
			else
				$data['ALIAS'] = $this->input->post('alias_old');
				
			//Upload File
			if($_FILES['file']['name'] != ''){
				$this->load->library('upload');
				$uploadConf = array(
						'file_name' 		=> "AGENDA_".$data['ALIAS'].'_'.date('YmdHis'),
						'upload_path'		=> $this->config->item('file_path_upload'),
						'allowed_types'		=> $this->config->item('file_allowed_type'),
						'overwrite'			=> 'TRUE'
				);
			
				$this->upload->initialize($uploadConf);
			
				if (!$this->upload->do_upload('file')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					if($id != null){
						redirect('backoffice/agenda/edit/'.$id);
					}else{
						redirect('backoffice/agenda/create');
					}
			
				}else{
					if($id != null && $this->input->post('file_old', TRUE) != ''){
						$filename =  $this->config->item('file_path_upload').$this->input->post('file_old', TRUE);
						if(file_exists($filename))	{
							unlink($filename);
						}
					}
			
					$upData 				= $this->upload->data();
					$data['FILE'] 	= $upData['file_name'];
				}
			}
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_Agenda_Model->updateData($data, $id);
				
				if($_FILES['file']['name'] != ''){
					redirect('backoffice/agenda');
				}
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Agenda_Model->insertData($data);
				
				if($_FILES['file']['name'] != ''){
					redirect('backoffice/agenda');
				}
			}
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/agenda');
		}
		redirect('backoffice/agenda/create');
	}
	
	function edit($id){
		$this->load->model('X_Agenda_Model');
		
		$obj = $this->X_Agenda_Model->getDataById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/agenda');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Agenda',
				'content'	 	=> 'back/agenda/agenda-edit',
				'contentData'	=> array(
						'row'			=> $obj->row(),
						
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_Agenda_Model');
		$obj = $this->X_Agenda_Model->getDataById($id);
			
		if($obj->num_rows() != 0){
			$filename =  $this->config->item('file_path_upload').$obj->row()->FILE;
			
			if($this->X_Agenda_Model->delData($obj->row()->ID)){
				if($obj->row()->FILE != "" && file_exists($filename))	{
					unlink($filename);
				}
				
				$this->session->set_flashdata('success', 'Data "'.$obj->row()->TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/agenda');
	}
	
	private function _getAlias($string){
		$this->load->model('X_Agenda_Model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
	
		$check = $this->X_Agenda_Model->getDataByAlias($newString);
	
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
}

/* End of file agenda.php */
/* Location: ./application/controllers/backoffice/agenda.php */