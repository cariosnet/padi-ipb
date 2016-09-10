<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 9/6/16
 * Time: 14:55
 */

class penangkar extends CI_Controller{

    function Institution(){
        parent::__construct();
        if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
    }

    public function index(){
        $this->load->model('X_Penangkar_Model');
        $this->load->model('X_Institution_Model');

        $data = array(
            'pageTitle' 	=> 'Penangkar',
            'content'	 	=> 'back/penangkar/penangkar-list',
            'contentData'	=> array(
                //'listPages'		=> $this->X_Pages_Model->getListPages(),
                'listPenangkar'		=> $this->X_Penangkar_Model->getListJoinPenangkar(NULL)
            )
        );

        $this->load->view('back/layout', $data);
    }

    public function create(){
        $this->load->model('X_Penangkar_Model');
        $this->load->model('X_Institution_Model');

        $data = array(
            'pageTitle' 	=> 'Buat Penangkar Baru',
            'content'	 	=> 'back/penangkar/penangkar-add',
            'contentData'	=> array(
                'listLembaga' => $this->X_Institution_Model->getListInstitution()
            )
        );

        $this->load->view('back/layout', $data);

    }

    function submit(){
        $this->load->model('X_Penangkar_Model');

        if($this->input->post('save') != ''){
            $id = $this->input->post('id');

            $data = array(
                'ID_INSTITUTION'    => $this->input->post('lembaga'),
                'DEST_CITY'    => $this->input->post('kota'),
                'DEST_STATE'    => $this->input->post('provinsi'),
                'VOL_3S'    => $this->input->post('3s'),
                'VOL_4S'    => $this->input->post('4s'),
                'SEND_DATE'    => date("Y-m-d",strtotime($this->input->post('send_date'))),
                'PRODUCER'    => $this->input->post('producer'),
                'SENDER'    => $this->input->post('sender'),
            );

            if($id != ''){

                $this->X_Penangkar_Model->updatePenangkar($data, $id);
            }else{

                $lastInsertedId = $this->X_Penangkar_Model->insertPenangkar($data);
            }

            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            redirect('backoffice/penangkar');
        }
        redirect('backoffice/penangkar/create');
    }

    function edit($id){
        $this->load->model('X_Penangkar_Model');
        $this->load->model('X_Institution_Model');

        $obj = $this->X_Penangkar_Model->getPenangkarById($id);

        if($obj->num_rows() == 0){
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('backoffice/penangkar');
        }

        $data = array(
            'pageTitle' 	=> 'Ubah Penangkar '.$obj->row()->name,
            'content'	 	=> 'back/penangkar/penangkar-edit',
            'contentData'	=> array(
                'penangkar'	=> $obj->row(),
                'listInstitution' => $this->X_Institution_Model->getListInstitution()
            )
        );

        $this->load->view('back/layout', $data);
    }

    function delete($id){
        $this->load->model('X_Penangkar_Model');
        $obj = $this->X_Penangkar_Model->getPenangkarById($id);

        if($obj->num_rows() != 0){
            if($this->X_Penangkar_Model->delPenangkar($obj->row()->ID)){
                $this->session->set_flashdata('success', 'Penagnkar berhasil dihapus.');
            }else{
                $this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
            }
        }else{
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('backoffice/penangkar');
    }

}