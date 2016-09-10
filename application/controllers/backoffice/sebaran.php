<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 9/6/16
 * Time: 14:55
 */

class sebaran extends CI_Controller{

    function Institution(){
        parent::__construct();
        if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
    }

    public function index(){
        $this->load->model('X_Wilayah_Model');
        $this->load->model('X_Sebaran_Model');

        $data = array(
            'pageTitle' 	=> 'Sebaran',
            'content'	 	=> 'back/sebaran/sebaran-list',
            'contentData'	=> array(
                //'listPages'		=> $this->X_Pages_Model->getListPages(),
                'listWilayah'		=> $this->X_Wilayah_Model->getListWilayah(NULL)
            )
        );

        $this->load->view('back/layout', $data);
    }

    public function create(){
        $this->load->model('X_Sebaran_Model');
        $this->load->model('X_Wilayah_Model');

        $data = array(
            'pageTitle' 	=> 'Buat Halaman Baru',
            'content'	 	=> 'back/sebaran/sebaran-add',
            'contentData'	=> array(
                'listWilayah' => $this->X_Wilayah_Model->getListWilayah()
            )
        );

        $this->load->view('back/layout', $data);

    }

    function submit(){
        $this->load->model('X_Sebaran_Model');

        if($this->input->post('save') != ''){
            $id = $this->input->post('id');

            $data = array(
                'name'   => $this->input->post('name'),
                'ID_WILAYAH'    => $this->input->post('wilayah'),
                'barang'    => $this->input->post('barang'),
                'bs'    => $this->input->post('bs'),
                'fs'    => $this->input->post('fs'),
                'ss'    => $this->input->post('ss')
            );

            if($id != ''){

                $this->X_Sebaran_Model->updateSebaran($data, $id);
            }else{

                $lastInsertedId = $this->X_Sebaran_Model->insertSebaran($data);
            }

            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            redirect('backoffice/sebaran');
        }
        redirect('backoffice/sebaran/create');
    }

    function edit($id){
        $this->load->model('X_Sebaran_Model');
        $this->load->model('X_Wilayah_Model');

        $obj = $this->X_Sebaran_Model->getSebaranById($id);

        if($obj->num_rows() == 0){
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('backoffice/sebaran');
        }

        $data = array(
            'pageTitle' 	=> 'Ubah Wilayah '.$obj->row()->name,
            'content'	 	=> 'back/sebaran/sebaran-edit',
            'contentData'	=> array(
                'sebaran'	=> $obj->row(),
                'listWilayah' => $this->X_Wilayah_Model->getListWilayah()
            )
        );

        $this->load->view('back/layout', $data);
    }

    function delete($id){
        $this->load->model('X_Sebaran_Model');
        $obj = $this->X_Sebaran_Model->getSebaranById($id);

        if($obj->num_rows() != 0){
            if($this->X_Sebaran_Model->delSebaran($obj->row()->id)){
                $this->session->set_flashdata('success', 'Wilayah "'.$obj->row()->name.'" berhasil dihapus.');
            }else{
                $this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
            }
        }else{
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('backoffice/sebaran');
    }

}