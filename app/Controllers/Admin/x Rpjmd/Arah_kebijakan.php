<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_arah_kebijakan;
use App\Models\Admin\RPJMD\Model_strategi;

class Arah_kebijakan extends BaseController
{
	protected $arah_kebijakan, $strategi;

	public function __construct()
	{
		$this->arah_kebijakan = new Model_arah_kebijakan();
		$this->strategi = new Model_strategi();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			$strategi = $this->strategi->findAll();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'arah_kebijakan',
				'title' => 'Admin | Arah Kebijakan',
				'lok' => '<b>Arah Kebijakan</b>',
				'strategi' => $strategi,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/arah_kebijakan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function arah_kebijakan_add()
	{
		if (has_permission('Admin')) :
			$strategi = $this->strategi->findAll();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'arah_kebijakan',
				'title' => 'Admin | Arah Kebijakan',
				'lok' => '<a href=".">Arah Kebijakan</a> -> <b>Tambah Arah Kebijakan</b>',
				'strategi' => $strategi,
			];
			echo view('admin/RPJMD/arah_kebijakan_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function arah_kebijakan_create()
	{
		if (has_permission('Admin')) :
			$this->arah_kebijakan->save([
				'arah_kebijakan' => $this->request->getVar('arah_kebijakan'),
				'strategi_id' => $this->request->getVar('strategi'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/arah_kebijakan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function arah_kebijakan_edit($id)
	{
		if (has_permission('Admin')) :
			$arah_kebijakan = $this->arah_kebijakan->arah_kebijakanEdit($id);
			$strategi = $this->strategi->findAll();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'arah_kebijakan',
				'title' => 'Admin | Arah Kebijakan',
				'lok' => '<a href="..">Arah Kebijakan</a> -> <b>Ubah Arah Kebijakan</b>',
				'roh' => $arah_kebijakan,
				'strategi' => $strategi,
			];
			echo view('admin/RPJMD/arah_kebijakan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function arah_kebijakan_update()
	{
		if (has_permission('Admin')) :
			$this->arah_kebijakan->save([
				'id_arah_kebijakan' => $this->request->getVar('id'),
				'arah_kebijakan' => $this->request->getVar('arah_kebijakan'),
				'strategi_id' => $this->request->getVar('strategi'),
				'updated_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/arah_kebijakan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function arah_kebijakan_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->arah_kebijakan->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/rpjmd/arah_kebijakan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
