<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_visi;
use App\Models\Admin\RPJMD\Model_misi;

class Visi extends BaseController
{
	protected $visi, $misi;

	public function __construct()
	{
		$this->visi = new Model_visi();
		$this->misi = new Model_misi();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'visi',
				'title' => 'Admin | VISI / MISI',
				'lok' => '<b>Visi</b>',
				'visi' => $this->visi->findAll(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/visi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function visi_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'visi',
				'title' => 'Admin | VISI / MISI',
				'lok' => '<a href="/admin/rpjmd/visi/">Visi / Misi</a> -> <b>Tambah Visi</b>',
				'nama' => 'Visi',
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/visi_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function visi_create()
	{
		if (has_permission('Admin')) :

			if (!$this->validate(
				[
					'visi' => 'required|is_unique[tb_visi.visi]',
				],
				[   // Errors
					'visi' => [
						'required' => 'Data tidak boleh kosong',
						'is_unique' => 'Data yang dimasukan sudah ada',
					],
				]
			)) {
				return redirect()->back()->withInput();
			}

			$data = [
				'visi' => $this->request->getVar('visi'),
				'kode_visi' => $this->request->getVar('kode_visi'),
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			];

			try {
				$this->visi->save($data);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data gagal di simpan.');
				return redirect()->back();
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/visi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function visi_edit($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'visi',
				'title' => 'Admin | VISI / MISI',
				'lok' => '<a href="/admin/rpjmd/visi/">Visi / Misi</a> -> <b>Ubah Visi</b>',
				'row' => $this->visi->find($id),
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/visi_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function visi_update()
	{
		if (has_permission('Admin')) :

			if (!$this->validate(
				[
					'visi' => 'required|is_unique[tb_visi.visi,visi,{visi}]',
				],
				[   // Errors
					'visi' => [
						'required' => 'Data tidak boleh kosong',
						'is_unique' => 'Data yang dimasukan sudah ada',
					],
				]
			)) {
				return redirect()->back()->withInput();
			}

			$data = [
				'id_visi' => $this->request->getVar('id'),
				'visi' => $this->request->getVar('visi'),
				'kode_visi' => $this->request->getVar('kode_visi'),
				'updated_by' => user()->full_name,
			];

			try {
				$this->visi->save($data);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data gagal di simpan.');
				return redirect()->back();
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/visi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function visi_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->visi->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->back();
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------

	public function misi_add($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'visi',
				'title' => 'Admin | VISI / MISI',
				'lok' => '<a href="/admin/rpjmd/visi/">Visi / Misi</a> -> <b>Tambah Misi</b>',
				'visi' => $this->visi->find($id),
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/misi_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function misi_create()
	{
		if (has_permission('Admin')) :
			if (!$this->validate(
				[
					'misi' => 'required|is_unique[tb_misi.misi]',
				],
				[   // Errors
					'misi' => [
						'required' => 'Data tidak boleh kosong',
						'is_unique' => 'Data yang dimasukan sudah ada',
					],
				]
			)) {
				return redirect()->back()->withInput();
			}

			$data = [
				'misi' => $this->request->getVar('misi'),
				'kode_misi' => $this->request->getVar('kode_misi'),
				'visi' => $this->request->getVar('visi'),
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			];

			try {
				$this->misi->save($data);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data gagal di simpan.');
				return redirect()->back();
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/visi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function misi_edit($id, $visi)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'visi',
				'title' => 'Admin | VISI / MISI',
				'lok' => '<a href="/admin/rpjmd/visi/">Visi / Misi</a> -> <b>Ubah Visi</b>',
				'nama' => 'Visi',
				'row' => $this->misi->find($id),
				'visi' => $this->visi->find($visi),
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/misi_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function misi_update()
	{
		if (has_permission('Admin')) :
			if (!$this->validate(
				[
					'misi' => 'required|is_unique[tb_misi.misi,misi,{misi}]',
				],
				[   // Errors
					'misi' => [
						'required' => 'Data tidak boleh kosong',
						'is_unique' => 'Data yang dimasukan sudah ada',
					],
				]
			)) {
				return redirect()->back()->withInput();
			}

			$data = [
				'id_misi' => $this->request->getVar('id_misi'),
				'misi' => $this->request->getVar('misi'),
				'kode_misi' => $this->request->getVar('kode_misi'),
				'updated_by' => user()->full_name,
			];

			try {
				$this->misi->save($data);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data gagal di simpan.');
				return redirect()->back();
			}

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/visi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function misi_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->misi->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/rpjmd/visi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
