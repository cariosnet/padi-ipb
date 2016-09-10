<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 9/6/16
 * Time: 14:55
 */

class wilayah extends CI_Controller{

    function Institution(){
        parent::__construct();
        if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
    }

    public function index(){
        $this->load->model('X_Wilayah_Model');

        $data = array(
            'pageTitle' 	=> 'Halaman',
            'content'	 	=> 'back/wilayah/wilayah-list',
            'contentData'	=> array(
                //'listPages'		=> $this->X_Pages_Model->getListPages(),
                'listWilayah'		=> $this->X_Wilayah_Model->getListWilayah(NULL)
            )
        );

        $this->load->view('back/layout', $data);
    }

    public function create(){
        $this->load->model('X_Status_Model');

        $data = array(
            'pageTitle' 	=> 'Buat Halaman Baru',
            'content'	 	=> 'back/wilayah/wilayah-add',
            'contentData'	=> array(
                //'listStatus' => $this->X_Status_Model->getListStatus()
            )
        );

        $this->load->view('back/layout', $data);

    }

    function submit(){
        $this->load->model('X_Wilayah_Model');

        if($this->input->post('save') != ''){
            $id = $this->input->post('id');

            $data = array(
                'NAME'   => $this->input->post('name'),
                'LAT'    => $this->input->post('lat'),
                'LNG'    => $this->input->post('lng')
            );

            if($id != ''){

                $this->X_Wilayah_Model->updateWilayah($data, $id);
            }else{

                $lastInsertedId = $this->X_Wilayah_Model->insertWilayah($data);
            }

            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            redirect('backoffice/wilayah');
        }
        redirect('backoffice/wilayah/create');
    }

    function edit($id){
        $this->load->model('X_Wilayah_Model');

        $obj = $this->X_Wilayah_Model->getWilayahById($id);

        if($obj->num_rows() == 0){
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('backoffice/wilayah');
        }

        $data = array(
            'pageTitle' 	=> 'Ubah Wilayah '.$obj->row()->NAME,
            'content'	 	=> 'back/wilayah/wilayah-edit',
            'contentData'	=> array(
                'wilayah'	=> $obj->row()
            )
        );

        $this->load->view('back/layout', $data);
    }

    function delete($id){
        $this->load->model('X_Wilayah_Model');
        $obj = $this->X_Wilayah_Model->getWilayahById($id);

        if($obj->num_rows() != 0){
            if($this->X_Wilayah_Model->delWilayah($obj->row()->ID)){
                $this->session->set_flashdata('success', 'Wilayah "'.$obj->row()->NAME.'" berhasil dihapus.');
            }else{
                $this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
            }
        }else{
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('backoffice/wilayah');
    }

}