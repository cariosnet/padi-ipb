<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 01:22
 */

class Institution extends CI_Controller{

    function Institution(){
        parent::__construct();
        if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
    }

    public function index(){
        $this->load->model('X_Institution_Model');

        $data = array(
            'pageTitle' 	=> 'Halaman',
            'content'	 	=> 'back/institution/institution-list',
            'contentData'	=> array(
                //'listPages'		=> $this->X_Pages_Model->getListPages(),
                'listParent'		=> $this->X_Institution_Model->getListInstitution(NULL)
            )
        );

        $this->load->view('back/layout', $data);
    }

    public function create(){
        $this->load->model('X_Status_Model');

        $data = array(
            'pageTitle' 	=> 'Buat Halaman Baru',
            'content'	 	=> 'back/institution/institution-add',
            'contentData'	=> array(
                'listStatus' => $this->X_Status_Model->getListStatus()
            )
        );

        $this->load->view('back/layout', $data);

    }

    function submit(){
        $this->load->model('X_Institution_Model');

        if($this->input->post('save') != ''){
            $id = $this->input->post('id');

            $data = array(
                'INSTITUTION_NAME'   => $this->input->post('name'),
                'ID_STATUS'		    => $this->input->post('status'),
                'REGION'		    => $this->input->post('area'),
                'DESC'			    => $this->input->post('desc'),
            );

            if($id != ''){

                $this->X_Institution_Model->updateInstitution($data, $id, $this->input->post('order_old'));
            }else{

                $lastInsertedId = $this->X_Institution_Model->insertInstitution($data);
            }

            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            redirect('backoffice/institution');
        }
        redirect('backoffice/institution/create');
    }

    function edit($id){
        $this->load->model('X_Pages_Model');

        $obj = $this->X_Pages_Model->getPagesById($id);

        if($obj->num_rows() == 0){
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('backoffice/institution');
        }

        $data = array(
            'pageTitle' 	=> 'Ubah Halaman '.$obj->row()->TITLE,
            'content'	 	=> 'back/institution/institution-edit',
            'contentData'	=> array(
                'pages'			=> $obj->row(),
                'listParent'		=> $this->X_Pages_Model->getListPagesByParent(NULL, 'A')
            )
        );

        $this->load->view('back/layout', $data);
    }

    function delete($id){
        $this->load->model('X_Pages_Model');
        $obj = $this->X_Pages_Model->getPagesById($id);

        if($obj->num_rows() != 0){
            if($this->X_Pages_Model->delPages($obj->row()->ID)){
                $this->session->set_flashdata('success', 'Halaman "'.$obj->row()->TITLE.'" berhasil dihapus.');
            }else{
                $this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
            }
        }else{
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('backoffice/institution');
    }
}