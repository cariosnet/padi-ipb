<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 9/6/16
 * Time: 14:55
 */

class stok extends CI_Controller{

    function Institution(){
        parent::__construct();
        if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
    }

    public function index(){
        $this->load->model('X_Stok_Model');
        $this->load->model('X_Institution_Model');

        $data = array(
            'pageTitle' 	=> 'Sebaran',
            'content'	 	=> 'back/stok/stok-list',
            'contentData'	=> array(
                //'listPages'		=> $this->X_Pages_Model->getListPages(),
                'listStok'		=> $this->X_Stok_Model->getListJoin()
            )
        );

        $this->load->view('back/layout', $data);
    }

    public function create(){
        $this->load->model('X_Institution_Model');
        $this->load->model('X_Benih_Model');

        $data = array(
            'pageTitle' 	=> 'Buat Stok Baru',
            'content'	 	=> 'back/stok/stok-add',
            'contentData'	=> array(
                'listLembaga' => $this->X_Institution_Model->getListLembaga(),
                'listBenih' => $this->X_Benih_Model->getListBenih(),
            )
        );

        $this->load->view('back/layout', $data);

    }

    function submit(){
        $this->load->model('X_Stok_Model');

        if($this->input->post('save') != ''){
            $id = $this->input->post('id');

            $data = array(
                'DATE'   => date("Y-m-d",strtotime($this->input->post('date'))),
                'ID_INSTITUTION'  => $this->input->post('institution'),
                'ID_BENIH'    => $this->input->post('benih'),
                'JUMLAH'    => $this->input->post('jumlah')
            );

            if($id != ''){

                $this->X_Stok_Model->updateStok($data, $id);
            }else{

                $lastInsertedId = $this->X_Stok_Model->insertStok($data);
            }

            $this->session->set_flashdata('success', 'Data berhasil disimpan.');
            redirect('backoffice/stok');
        }
        redirect('backoffice/stok/create');
    }

    function edit($id){
        $this->load->model('X_Stok_Model');
        $this->load->model('X_Benih_Model');
        $this->load->model('X_Institution_Model');

        $obj = $this->X_Stok_Model->getStokById($id);

        if($obj->num_rows() == 0){
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('backoffice/sebaran');
        }

        $data = array(
            'pageTitle' 	=> 'Ubah Wilayah '.$obj->row()->name,
            'content'	 	=> 'back/stok/stok-edit',
            'contentData'	=> array(
                'stok'	=> $obj->row(),
                'lembaga' => $this->X_Institution_Model->getListLembaga(),
                'benih' => $this->X_Benih_Model->getListBenih()
            )
        );

        $this->load->view('back/layout', $data);
    }

    function delete($id){
        $this->load->model('X_Stok_Model');
        $obj = $this->X_Stok_Model->getStokById($id);

        if($obj->num_rows() != 0){
            if($this->X_Stok_Model->delStok($obj->row()->ID)){
                $this->session->set_flashdata('success', 'Stok "'.$obj->row()->DATE.'" berhasil dihapus.');
            }else{
                $this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
            }
        }else{
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
        }

        redirect('backoffice/stok');
    }

}