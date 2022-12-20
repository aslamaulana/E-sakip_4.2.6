<?php

namespace App\Controllers\User\Dpa;

use App\Controllers\BaseController;
use App\Models\User\Dpa\Model_dpa_indikator;
use App\Models\Admin\RPJMD\Model_satuan;

class Dpa_indikator extends BaseController
{
	protected $dpa_indikator, $satuan;

	public function __construct()
	{
		$this->dpa_indikator = new Model_dpa_indikator();
		$this->satuan = new Model_satuan();
	}

	public function dpa_indikator($id = '', $nm = '')
	{
		if (has_permission('User')) :
			$dpa_indikator = $this->dpa_indikator->find($id);
			$data = [
				'gr' => 'dpa',
				'mn' => 'dpa',
				'title' => 'User | DPA',
				'lok' => '<a href="/user/dpa/dpa">DPA</a> -><b>DPA Indikator</b>',
				'dpa_indikator' => $dpa_indikator,
				'id_dpa' => $id,
				'nm' => $nm,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Dpa/dpa_indikator', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function dpa_indikator_add($id = '', $nm = '')
	{
		if (has_permission('User')) :
			$satuan = $this->satuan->findAll();
			$data = [
				'gr' => 'dpa',
				'mn' => 'dpa',
				'title' => 'User | DPA',
				'lok' => '<a onclick="history.back(-1)" href="#">DPA Indikator</a> -> <b>Tambah DPA Indikator</b>',
				'validation' => \Config\Services::validation(),
				'id_dpa' => $id,
				'nm' => $nm,
				'satuan' => $satuan,
			];
			echo view('user/Dpa/dpa_indikator_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function dpa_indikator_create()
	{
		if (has_permission('User')) :
			$this->dpa_indikator->save([
				'dpa_id' => $this->request->getVar('id_dpa'),
				'indikator' => $this->request->getVar('indikator'),
				'type' => $this->request->getVar('type'),
				'satuan_id' => $this->request->getVar('satuan'),
				'target_akhir' => $this->request->getVar('target_akhir'),
				'tahun' => $_SESSION['tahun'],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/dpa/dpa_indikator/dpa_indikator/' . $this->request->getVar('id_dpa') . '/' . $this->request->getVar('nm'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function dpa_indikator_edit($id_sub = '', $id = '', $nm = '')
	{
		if (has_permission('User')) :
			$satuan = $this->satuan->findAll();
			$dpa_indikator = $this->dpa_indikator->id_dpa_indikator($id_sub);
			$data = [
				'gr' => 'dpa',
				'mn' => 'dpa',
				'title' => 'User | DPA',
				'lok' => '<a onclick="history.back(-1)" href="#">DPA Indikator</a> -> <b>Ubah DPA Indikator</b>',
				'validation' => \Config\Services::validation(),
				'id_dpa_indikator' => $dpa_indikator,
				'id_dpa' => $id,
				'nm' => $nm,
				'satuan' => $satuan,
			];
			echo view('user/Dpa/dpa_indikator_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function dpa_indikator_update()
	{
		if (has_permission('User')) :
			$this->dpa_indikator->save([
				'id_dpa_indikator' => $this->request->getVar('id_dpa_indikator'),
				'dpa_id' => $this->request->getVar('id_dpa'),
				'indikator' => $this->request->getVar('indikator'),
				'type' => $this->request->getVar('type'),
				'satuan_id' => $this->request->getVar('satuan'),
				'target_akhir' => $this->request->getVar('target_akhir'),
				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/dpa/dpa_indikator/dpa_indikator/' . $this->request->getVar('id_dpa') . '/' . $this->request->getVar('nm'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function dpa_indikator_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->dpa_indikator->delete($id);
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
}
