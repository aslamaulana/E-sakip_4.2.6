<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_visi;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\Admin\RPJMD\Model_tujuan;
use App\Models\Admin\RPJMD\Model_tahun;

class Tujuan extends BaseController
{
	protected $visi, $misi, $tujuan, $satuan, $tahun, $tujuan_indik_target;

	public function __construct()
	{
		$this->visi = new Model_visi();
		$this->tujuan = new Model_tujuan();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			$tahunA = $this->tahun->tahunA();
			$visi = $this->tujuan->visi();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<b>Tujuan</b>',
				'visi' => $visi,
				'tahunA' => $tahunA,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/tujuan', $data);
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
	public function tujuan_add()
	{
		if (has_permission('Admin')) :
			$visi = $this->visi->findAll();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<a href="/admin/rpjmd/tujuan">Tujuan</a> -> <b>Tambah Tujuan</b>',
				'satuan' => $this->satuan->satuan(),
				'visi' => $visi,
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/tujuan_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tujuan_create()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([

				'visi' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'misi' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'indikator_tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->tujuan->save([
				'misi_n' => $this->request->getVar('misi'),
				'tujuan' => $this->request->getVar('tujuan'),
				'kode_tujuan' => $this->request->getVar('kode_tujuan'),
				'indikator_tujuan' => $this->request->getVar('indikator_tujuan'),
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
			return redirect()->to(base_url() . '/admin/rpjmd/tujuan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tujuan_edit()
	{
		if (has_permission('Admin')) :
			$p = $_GET['p'];
			$k = $_GET['k'];
			$m = $_GET['m'];
			$tujuan = $this->tujuan->tujuanEdit($p, $k, $m);
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<a href="/admin/rpjmd/tujuan">Tujuan</a> -> <b>Ubah Tujuan</b>',
				'visi' => $this->visi->findAll(),
				'tujuan' => $tujuan,
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
			echo view('admin/RPJMD/tujuan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tujuan_update()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([
				'misi' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$data = [
				'misi_n' => $this->request->getVar('misi'),
				'tujuan' => $this->request->getVar('tujuan'),
				'kode_tujuan' => $this->request->getVar('kode_tujuan'),
				'updated_by' => user()->full_name,
			];
			$dataw = [
				'misi_n' => $this->request->getVar('misi_old'),
				'kode_tujuan' => $this->request->getVar('kode_tujuan_old'),
				'tujuan' => $this->request->getVar('tujuan_old')
			];
			// dd($dataf);
			$this->tujuan->set($data)->where($dataw)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/tujuan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function tujuan_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->tujuan->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/rpjmd/tujuan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------

	public function tujuan_indik_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Tujuan</a> -> <b>Tambah Indikator Tujuan</b>',
				'validation' => \Config\Services::validation(),
				'tujuan' => $_GET['p'],
				'kode_tujuan' => $_GET['k'],
				'misi_n' => $_GET['m'],
				'satuan' => $this->satuan->satuan(),
			];
			echo view('admin/RPJMD/tujuan_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tujuan_indik_create()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([
				'indikator_tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->tujuan->save([
				'misi_n' => $this->request->getVar('misi'),
				'tujuan' => $this->request->getVar('tujuan'),
				'kode_tujuan' => $this->request->getVar('kode_tujuan'),
				'indikator_tujuan' => $this->request->getVar('indikator_tujuan'),
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
			return redirect()->to(base_url() . '/admin/rpjmd/tujuan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tujuan_indik_edit($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Tujuan</a> -> <b>Ubah Indikator Tujuan</b>',
				'validation' => \Config\Services::validation(),
				// 'tujuan' => $_GET['p'],
				// 'kode_tujuan' => $_GET['k'],
				// 'misi_n' => $_GET['m'],
				'satuan' => $this->satuan->satuan(),
				'indikator' => $this->tujuan->find($id),
			];
			echo view('admin/RPJMD/tujuan_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function tujuan_indik_update()
	{
		if (has_permission('Admin')) :
			if (!$this->validate([
				'indikator_tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->tujuan->save([
				'id_tujuan' => $this->request->getVar('id_tujuan'),
				'indikator_tujuan' => $this->request->getVar('indikator_tujuan'),
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
			return redirect()->to(base_url() . '/admin/rpjmd/tujuan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
