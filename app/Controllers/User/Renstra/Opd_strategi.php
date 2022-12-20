<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_strategi;

class Opd_strategi extends BaseController
{
	protected $opd_strategi, $opd_sasaran;

	public function __construct()
	{
		$this->opd_strategi = new Model_opd_strategi();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_strategi',
				'title' => 'User | PD STRATEGI',
				'lok' => '<b>PD Strategi</b>',
				'opd_strategi' => $this->opd_strategi->Strategi(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_strategi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_strategi_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_strategi',
				'title' => 'User | PD STRATEGI',
				'lok' => '<a href=".">PD Strategi</a> -> <b>Tambah PD Strategi</b>',
				'opd_sasaran' => $this->opd_strategi->getSasaran(),
			];
			echo view('user/Renstra/opd_strategi_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_strategi_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :

			$this->opd_strategi->save([
				'opd_strategi' => $this->request->getVar('strategi'),
				'opd_kode_sasaran_n' => json_decode($this->request->getVar('sasaran'), true)['kode'],
				'opd_sasaran_n' => json_decode($this->request->getVar('sasaran'), true)['sasaran'],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_strategi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_strategi_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_strategi',
				'title' => 'User | PD STRATEGI',
				'lok' => '<a href="..">PD Strategi</a> -> <b>Ubah PD Strategi</b>',
				'roh' => $this->opd_strategi->StrategiEdit($id),
				'opd_sasaran' => $this->opd_strategi->getSasaran(),
			];
			echo view('user/Renstra/opd_strategi_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_strategi_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$this->opd_strategi->save([
				'id_opd_strategi' => $this->request->getVar('id'),
				'opd_strategi' => $this->request->getVar('strategi'),
				'opd_kode_sasaran_n' => json_decode($this->request->getVar('sasaran'), true)['kode'],
				'opd_sasaran_n' => json_decode($this->request->getVar('sasaran'), true)['sasaran'],
				'updated_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_strategi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_strategi_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_strategi->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_strategi/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// =======================================================================================================

	public function import_strategi()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :

			$data = $this->opd_strategi->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'opd_strategi' => $data[$key]['opd_strategi'],
					'opd_kode_sasaran_n' => $data[$key]['opd_kode_sasaran_n'],
					'opd_sasaran_n' => $data[$key]['opd_sasaran_n'],
					'opd_id' => user()->opd_id,
					'perubahan' => $_SESSION['perubahan'],
					'created_by' => user()->full_name,
				);
			}
			$this->opd_strategi->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_strategi');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
