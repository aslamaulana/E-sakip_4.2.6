<?php

namespace App\Controllers\User\Opd;

use App\Controllers\BaseController;
use App\Models\User\Opd\Model_bidang;
use App\Models\User\Opd\Model_bidang_sub;

class Bidang extends BaseController
{
	protected $bidang, $bidang_sub;

	public function __construct()
	{
		$this->bidang = new Model_bidang();
		$this->bidang_sub = new Model_bidang_sub();
	}

	public function index()
	{
		if (has_permission('User')) :
			$bidang = $this->bidang->bidang();
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | Bidang / Sub Bidang',
				'lok' => '<b>Bidang</b>',
				'bidang' => $bidang,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Opd/bidang', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_add()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | Bidang / Sub Bidang',
				'lok' => '<a href=".">Bidang</a> -> <b>Tambah Bidang</b>',
			];
			echo view('user/Opd/bidang_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_create()
	{
		if (has_permission('User')) :
			$this->bidang->save([
				'kode' => $this->request->getVar('kode'),
				'nama_bidang' => $this->request->getVar('nama_bidang'),
				'kepala_bidang' => $this->request->getVar('kepala_bidang'),
				'nip' => $this->request->getVar('nip'),
				'golongan' => $this->request->getVar('golongan'),
				'eselon' => $this->request->getVar('eselon'),
				'aktif' => $this->request->getVar('aktif'),
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/opd/bidang');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_edit($id)
	{
		if (has_permission('User')) :
			$bidang = $this->bidang->find($id);
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | Bidang / Sub Bidang',
				'lok' => '<a href="..">Bidang</a> -> <b>Ubah Bidang</b>',
				'bidang' => $bidang,
			];
			echo view('user/Opd/bidang_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_update()
	{
		if (has_permission('User')) :
			$this->bidang->save([
				'id_opd_bidang' => $this->request->getVar('id_opd_bidang'),
				'kode' => $this->request->getVar('kode'),
				'nama_bidang' => $this->request->getVar('nama_bidang'),
				'kepala_bidang' => $this->request->getVar('kepala_bidang'),
				'nip' => $this->request->getVar('nip'),
				'golongan' => $this->request->getVar('golongan'),
				'eselon' => $this->request->getVar('eselon'),
				'aktif' => $this->request->getVar('aktif'),
				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/opd/bidang');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function bidang_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->bidang->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/Opd/bidang');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------

	public function bidang_sub_add($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | Bidang / Sub Bidang',
				'lok' => '<a onclick="history.back(-3)" href="#">Bidang</a> -> <b>Tambah Sub Bidang</b>',
				'bidang' => $this->bidang->find($id),
			];
			echo view('user/Opd/bidang_sub_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_sub_create()
	{
		if (has_permission('User')) :
			$this->bidang_sub->save([
				'opd_bidang_id' => $this->request->getVar('opd_bidang_id'),
				'kode_sub' => $this->request->getVar('kode_sub'),
				'nama_bidang_sub' => $this->request->getVar('nama_bidang_sub'),
				'kepala_bidang_sub' => $this->request->getVar('kepala_bidang_sub'),
				'nip_sub' => $this->request->getVar('nip_sub'),
				'golongan_sub' => $this->request->getVar('golongan_sub'),
				'eselon_sub' => $this->request->getVar('eselon_sub'),
				'aktif_sub' => $this->request->getVar('aktif_sub'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/opd/bidang');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_sub_edit($id, $id_bidang)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | Bidang / Sub Bidang',
				'lok' => '<a href="/user/opd/bidang">Bidang</a> -> <b>Ubah Sub Bidang</b>',
				'bidang_sub' => $this->bidang_sub->find($id),
				'bidang' => $this->bidang->find($id_bidang),
			];
			echo view('user/Opd/bidang_sub_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_sub_update()
	{
		if (has_permission('User')) :
			$this->bidang_sub->save([
				'id_opd_bidang_sub' => $this->request->getVar('id_opd_bidang_sub'),
				'kode_sub' => $this->request->getVar('kode_sub'),
				'nama_bidang_sub' => $this->request->getVar('nama_bidang_sub'),
				'kepala_bidang_sub' => $this->request->getVar('kepala_bidang_sub'),
				'nip_sub' => $this->request->getVar('nip_sub'),
				'golongan_sub' => $this->request->getVar('golongan_sub'),
				'eselon_sub' => $this->request->getVar('eselon_sub'),
				'aktif_sub' => $this->request->getVar('aktif_sub'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/opd/bidang');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function bidang_sub_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->bidang_sub->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/Opd/bidang');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
