<?php
defined ('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Mahasiswa extends CI_Controller {

	public function __construct()
	{

		parent:: __construct();
		$this->load->model('mahasiswa_model');
	}

	public function Index()
	{
		$data['title'] = 'Mahasiswa';
		$data['mahasiswa'] = $this->mahasiswa_model->get_data('tbl_siswaa')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('mahasiswa', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Mahasiswa';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tambah_mahasiswa');
		$this->load->view('templates/footer');

	}

	public function tambah_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
		$this->tambah();
		} else {
			$data = array (

				'nama_siswa' => $this->input->post('nama_siswa'),
				'kelas_siswa' => $this->input->post('kelas_siswa'),
				'alamat_siswa' => $this->input->post('alamat_siswa'),
				'nomor_telepon' => $this->input->post('nomor_telepon'),
			);

			$this->mahasiswa_model->insert_data($data, 'tbl_siswaa');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Data Berhasil Ditambahkan!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('mahasiswa');
		}
	}

	public function edit($id_siswaa)
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array (
				'id_siswaa'=>$id_siswaa,
				'nama_siswa' => $this->input->post('nama_siswa'),
				'kelas_siswa' => $this->input->post('kelas_siswa'),
				'alamat_siswa' => $this->input->post('alamat_siswa'),
				'nomor_telepon' => $this->input->post('nomor_telepon'),
			);

			$this->mahasiswa_model->update_data($data, 'tbl_siswaa');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Data Berhasil Diubah!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('mahasiswa');
		}


	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required', array(
			'required' => '%s harus diisi !!'
		));
		$this->form_validation->set_rules('kelas_siswa', 'Kelas Siswa', 'required', array(
			'required' => '%s harus diisi !!'
		));
		$this->form_validation->set_rules('alamat_siswa', 'Alamat Siswa', 'required', array(
			'required' => '%s harus diisi !!'
		));
		$this->form_validation->set_rules('nomor_telepon', 'Nomor telepon', 'required', array(
			'required' => '%s harus diisi !!'
		));
		$this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required', array(
			'required' => '%s harus diisi !!'
		));
	}

	public function delete($id)
	{
		$where = array ('id_siswaa' => $id);

		$this->mahasiswa_model->delete($where, 'tbl_siswaa');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
 		Data Berhasil Dihapus!
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('mahasiswa');
	}
}
	