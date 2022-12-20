<?php

namespace App\Controllers\User\Dpa;

use App\Controllers\BaseController;
use App\Models\User\Dpa\Model_dpa;

class Dpa extends BaseController
{
	protected $dpa, $bidang_sub;

	public function __construct()
	{
		$this->dpa = new Model_dpa();
	}

	public function index()
	{
		if (has_permission('User')) :
			$dpa = $this->dpa->dpa_program();
			$data = [
				'gr' => 'dpa',
				'mn' => 'dpa',
				'title' => 'User | DPA',
				'lok' => '<b>DPA</b>',
				'dpa' => $dpa,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Dpa/dpa', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ambil_kegiatan()
	{
		$opd_program = $this->request->getVar('id');
		$data = $this->dpa->get_kegiatan($opd_program);

		echo json_encode($data);
	}
	public function ambil_kegiatan_sub()
	{
		$opd_kegiatan = $this->request->getVar('id');
		$data = $this->dpa->get_kegiatan_sub($opd_kegiatan);

		echo json_encode($data);
	}
	public function dpa_add()
	{
		if (has_permission('User')) :
			$opd_program = $this->dpa->opd_program();
			$opd_bidang_sub = $this->dpa->opd_bidang_sub();
			$data = [
				'gr' => 'dpa',
				'mn' => 'dpa',
				'title' => 'User | DPA',
				'lok' => '<a onclick="history.back(-1)" href="#">DPA</a> -> <b>Tambah DPA</b>',
				'validation' => \Config\Services::validation(),
				'opd_program' => $opd_program,
				'opd_bidang_sub' => $opd_bidang_sub,
			];
			echo view('user/Dpa/dpa_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function dpa_create()
	{
		if (has_permission('User')) :
			$this->dpa->save([
				'opd_kegiatan_sub_id' => $this->request->getVar('opd_kegiatan_sub'),
				'bidang_sub_id' => $this->request->getVar('opd_bidang_sub'),
				'pagu_dpa' => $this->request->getVar('pagu'),
				'lokasi' => $this->request->getVar('lokasi'),
				'sasaran_sub_kegiatan' => $this->request->getVar('sasaran_sub_kegiatan'),
				'tgl_mulai' => $this->request->getVar('tanggal_mulai'),
				'tgl_selesai' => $this->request->getVar('tanggal_selesai'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/dpa/dpa');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function dpa_edit($id)
	{
		if (has_permission('User')) :
			$opd_program = $this->dpa->opd_program();
			$opd_bidang_sub = $this->dpa->opd_bidang_sub();
			$dpa = $this->dpa->dpa_edit($id);
			$data = [
				'gr' => 'dpa',
				'mn' => 'dpa',
				'title' => 'User | DPA',
				'lok' => '<a onclick="history.back(-1)" href="#">DPA</a> -> <b>Ubah DPA</b>',
				'validation' => \Config\Services::validation(),
				'opd_program' => $opd_program,
				'opd_bidang_sub' => $opd_bidang_sub,
				'dpa' => $dpa,
			];
			echo view('user/Dpa/dpa_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function dpa_update()
	{
		if (has_permission('User')) :
			$this->dpa->save([
				'id_dpa' => $this->request->getVar('id_dpa'),
				'opd_kegiatan_sub_id' => $this->request->getVar('opd_kegiatan_sub'),
				'bidang_sub_id' => $this->request->getVar('opd_bidang_sub'),
				'pagu_dpa' => $this->request->getVar('pagu'),
				'lokasi' => $this->request->getVar('lokasi'),
				'sasaran_sub_kegiatan' => $this->request->getVar('sasaran_sub_kegiatan'),
				'tgl_mulai' => $this->request->getVar('tanggal_mulai'),
				'tgl_selesai' => $this->request->getVar('tanggal_selesai'),
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/dpa/dpa');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function dpa_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->dpa->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/dpa/dpa');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------

	public function bidang_sub_add($id, $nm)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | Bidang / Sub Bidang',
				'lok' => '<a href=".">Bidang</a> -> <b>Tambah Sub Bidang</b>',
				'bidang_id' => $id,
				'nama_bidang' => $nm,
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
	public function bidang_sub_edit($id)
	{
		if (has_permission('User')) :
			$bidang_sub = $this->bidang_sub->find($id);
			$data = [
				'gr' => 'opd',
				'mn' => 'bidang',
				'title' => 'User | Bidang / Sub Bidang',
				'lok' => '<a href="..">Bidang</a> -> <b>Ubah Sub Bidang</b>',
				'bidang_sub' => $bidang_sub,
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
