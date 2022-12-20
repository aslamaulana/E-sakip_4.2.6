<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_sasaran;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\Admin\RPJMD\Model_tujuan;
use App\Models\Admin\RPJMD\Model_tahun;

class Sasaran extends BaseController
{
	protected $sasaran, $misi, $tujuan, $satuan, $tahun, $tujuan_indik_target;

	public function __construct()
	{
		$this->sasaran = new Model_sasaran();
		$this->tujuan = new Model_tujuan();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			$tahunA = $this->tahun->tahunA();
			$tujuan = $this->sasaran->tujuan();
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
	public function AmbilMisi()
	{
		$visi = $this->request->getVar('visi');
		$data = $this->tujuan->getMisi($visi);

		echo json_encode($data);
	}
	public function sasaran_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a href="/admin/rpjmd/sasaran">sasaran</a> -> <b>Tambah Sasaran</b>',
				'satuan' => $this->satuan->satuan(),
				'tujuan' => $this->sasaran->getTujuan(),
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
				'indikator_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->sasaran->save([
				'tujuan_n' => $this->request->getVar('tujuan'),
				'sasaran' => $this->request->getVar('sasaran'),
				'kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'indikator_sasaran' => $this->request->getVar('indikator_sasaran'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_edit()
	{
		if (has_permission('Admin')) :
			$p = $_GET['p'];
			$k = $_GET['k'];
			$m = $_GET['m'];
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a href="/admin/rpjmd/sasaran">Sasaran</a> -> <b>Ubah Sasaran</b>',
				'tujuan' => $this->sasaran->getTujuan(),
				'sasaran' => $this->sasaran->sasaranEdit($p, $k, $m),
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
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
				return redirect()->back()->withInput();
			}

			$data = [
				'tujuan_n' => $this->request->getVar('tujuan'),
				'sasaran' => $this->request->getVar('sasaran'),
				'kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'updated_by' => user()->full_name,
			];
			$dataw = [
				'tujuan_n' => $this->request->getVar('tujuan_old'),
				'kode_sasaran' => $this->request->getVar('kode_sasaran_old'),
				'sasaran' => $this->request->getVar('sasaran_old')
			];
			// dd($dataf);
			$this->sasaran->set($data)->where($dataw)->update();

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

	public function sasaran_indik_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Tambah Indikator Sasaran</b>',
				'validation' => \Config\Services::validation(),
				'sasaran' => $_GET['p'],
				'kode_sasaran' => $_GET['k'],
				'tujuan_n' => $_GET['m'],
				'satuan' => $this->satuan->satuan(),
			];
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
				return redirect()->back()->withInput();
			}

			$this->sasaran->save([
				'tujuan_n' => $this->request->getVar('tujuan'),
				'sasaran' => $this->request->getVar('sasaran'),
				'kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'indikator_sasaran' => $this->request->getVar('indikator_sasaran'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sasaran_indik_edit($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Ubah Indikator Sasaran</b>',
				'validation' => \Config\Services::validation(),
				'satuan' => $this->satuan->satuan(),
				'indikator' => $this->sasaran->find($id),
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
				return redirect()->back()->withInput();
			}

			$this->sasaran->save([
				'id_sasaran' => $this->request->getVar('id_sasaran'),
				'indikator_sasaran' => $this->request->getVar('indikator_sasaran'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
