<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_strategi;

class Strategi extends BaseController
{
	protected $strategi;

	public function __construct()
	{
		$this->strategi = new Model_strategi();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			$sasaran = $this->strategi->Strategi();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'strategi',
				'title' => 'Admin | STRATEGI',
				'lok' => '<b>Strategi</b>',
				'sasaran' => $sasaran,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/strategi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function strategi_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'strategi',
				'title' => 'Admin | STRATEGI',
				'lok' => '<a href=".">Strategi</a> -> <b>Tambah Strategi</b>',
				'sasaran' => $this->strategi->getSasaran(),
			];
			echo view('admin/RPJMD/strategi_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function strategi_create()
	{
		if (has_permission('Admin')) :
			$this->strategi->save([
				'strategi' => $this->request->getVar('strategi'),
				'sasaran_n' => $this->request->getVar('sasaran'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/strategi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function strategi_edit($id)
	{
		if (has_permission('Admin')) :
			$strategi = $this->strategi->StrategiEdit($id);
			$sasaran = $this->strategi->getSasaran();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'strategi',
				'title' => 'Admin | STRATEGI',
				'lok' => '<a href="..">Strategi</a> -> <b>Ubah Strategi</b>',
				'roh' => $strategi,
				'sasaran' => $sasaran,
			];
			echo view('admin/RPJMD/strategi_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function strategi_update()
	{
		if (has_permission('Admin')) :
			$this->strategi->save([
				'id_strategi' => $this->request->getVar('id'),
				'strategi' => $this->request->getVar('strategi'),
				'sasaran_n' => $this->request->getVar('sasaran'),
				'updated_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/strategi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function strategi_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->strategi->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/rpjmd/strategi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
