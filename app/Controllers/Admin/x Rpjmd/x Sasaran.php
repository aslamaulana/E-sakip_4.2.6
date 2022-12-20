<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_tujuan;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\Admin\RPJMD\Model_sasaran;
use App\Models\Admin\RPJMD\Model_sasaran_indik;
use App\Models\Admin\RPJMD\Model_sasaran_indik_target;
use App\Models\Admin\RPJMD\Model_tahun;

class Sasaran extends BaseController
{
	protected $tujuan, $sasaran, $satuan, $tahun, $sasaran_indik_target;

	public function __construct()
	{
		$this->tujuan = new Model_tujuan();
		$this->sasaran = new Model_sasaran();
		$this->satuan = new Model_satuan();
		$this->sasaran_indik = new Model_sasaran_indik();
		$this->tahun = new Model_tahun();
		$this->sasaran_indik_target = new Model_sasaran_indik_target();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			$tahunA = $this->tahun->tahunA();
			$tujuan = $this->tujuan->findAll();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<b>Sasaran</b>',
				'tujuan' => $tujuan,
				'tahunA' => $tahunA,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/sasaran', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_add()
	{
		if (has_permission('Admin')) :
			$tujuan = $this->tujuan->findAll();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a href=".">Sasaran</a> -> <b>Tambah Sasaran</b>',
				'tujuan' => $tujuan,
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/sasaran_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_create()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([

				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->to('/admin/rpjmd/sasaran/sasaran_add')->withInput();
			}

			$this->sasaran->save([
				'tujuan_id' => $this->request->getVar('tujuan'),
				'sasaran' => $this->request->getVar('sasaran'),
				'kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_edit($id)
	{
		if (has_permission('Admin')) :
			$tujuan = $this->tujuan->findAll();
			$sasaran = $this->sasaran->sasaranEdit($id);
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a href="..">Sasaran</a> -> <b>Ubah Sasaran</b>',
				'tujuan' => $tujuan,
				'sasaran' => $sasaran,
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/sasaran_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_update()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([

				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->to('/admin/rpjmd/sasaran/sasaran_edit')->withInput();
			}
			$this->sasaran->save([
				'id_sasaran' => $this->request->getVar('id_sasaran'),
				'tujuan_id' => $this->request->getVar('tujuan'),
				'kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'sasaran' => $this->request->getVar('sasaran'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function sasaran_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->sasaran->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------

	public function sasaran_indik_add($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Tambah Indikator sasaran</b>',
				'validation' => \Config\Services::validation(),
				'id_sasaran' => $id,
				'sasaran' => $this->sasaran->find($id),
				'satuan' => $this->satuan->satuan(),
				'tahunA' => $this->tahun->tahunA(),
				'tahunT' => $this->tahun->tahunT()
			];
			// dd($data);
			echo view('admin/RPJMD/sasaran_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_indik_create()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([

				'indikator_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->to('/admin/rpjmd/sasaran/sasaran_indik_add')->withInput();
			}

			$make_id = uniqid() . date("YmdHis"); // manual id

			$this->sasaran_indik->save([
				'id_sasaran_indik' => $make_id,
				'sasaran_indikator' => $this->request->getVar('indikator_sasaran'),
				'sasaran_id' => $this->request->getVar('id_sasaran'),
				'satuan_id' => $this->request->getVar('satuan'),
				'created_by' => user()->full_name,
			]);

			foreach ($_POST['tahun'] as $key => $val) {
				$result[] = array(
					'tahun' => $_POST['tahun'][$key],
					'sasaran_indik_id' => $make_id,
					'target' => $_POST['target'][$key],
					'created_by' => user()->full_name,
				);
			}

			$this->sasaran_indik_target->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_indik_edit($id, $id_sasaran)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Tambah Indikator sasaran</b>',
				'validation' => \Config\Services::validation(),
				'sasaran' => $this->sasaran->find($id_sasaran),
				'indik' => $this->sasaran_indik->indikEdit($id),
				'satuan' => $this->satuan->satuan(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/sasaran_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_indik_update()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([

				'indikator_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->to('/admin/rpjmd/sasaran/sasaran_indik_edit')->withInput();
			}

			$this->sasaran_indik->save([
				'id_sasaran_indik' => $this->request->getVar('id_sasaran_indik'),
				'sasaran_indikator' => $this->request->getVar('indikator_sasaran'),
				'satuan_id' => $this->request->getVar('satuan'),
				'updated_by' => user()->full_name,
			]);

			foreach ($_POST['tahun'] as $key => $val) {
				$result[] = array(
					'id_sasaran_indik_target' => $_POST['id_target'][$key],
					'tahun' => $_POST['tahun'][$key],
					'target' => $_POST['target'][$key],
					'updated_by' => user()->full_name,
				);
			}

			$this->sasaran_indik_target->updateBatch($result, 'id_sasaran_indik_target');

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_indik_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->sasaran_indik->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
