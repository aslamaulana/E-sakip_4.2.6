<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_arah_kebijakan;
use App\Models\User\Renstra\Model_opd_strategi;

class Opd_arah_kebijakan extends BaseController
{
	protected $opd_arah_kebijakan, $opd_strategi;

	public function __construct()
	{
		$this->opd_arah_kebijakan = new Model_opd_arah_kebijakan();
		$this->opd_strategi = new Model_opd_strategi();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_arah_kebijakan',
				'title' => 'User | PD Arah Kebijakan',
				'lok' => '<b>PD Arah Kebijakan</b>',
				'opd_strategi' => $this->opd_arah_kebijakan->ArahKebijakan(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_arah_kebijakan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_arah_kebijakan_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_arah_kebijakan',
				'title' => 'User | PD Arah Kebijakan',
				'lok' => '<a href=".">PD Arah Kebijakan</a> -> <b>Tambah PD Arah Kebijakan</b>',
				'opd_strategi' =>  $this->opd_arah_kebijakan->getStrategi(),
			];
			echo view('user/Renstra/opd_arah_kebijakan_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_arah_kebijakan_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$this->opd_arah_kebijakan->save([
				'opd_arah_kebijakan' => $this->request->getVar('opd_arah_kebijakan'),
				'opd_strategi_n' => $this->request->getVar('strategi'),
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_arah_kebijakan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_arah_kebijakan_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_arah_kebijakan',
				'title' => 'User | PD Arah Kebijakan',
				'lok' => '<a href="..">PD Arah Kebijakan</a> -> <b>Ubah PD Arah Kebijakan</b>',
				'roh' => $this->opd_arah_kebijakan->ArahKebijakanEdit($id),
				'opd_strategi' =>  $this->opd_arah_kebijakan->getStrategi(),
			];
			echo view('user/Renstra/opd_arah_kebijakan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_arah_kebijakan_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$this->opd_arah_kebijakan->save([
				'id_opd_arah_kebijakan' => $this->request->getVar('id'),
				'opd_arah_kebijakan' => $this->request->getVar('opd_arah_kebijakan'),
				'opd_strategi_n' => $this->request->getVar('strategi'),
				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_arah_kebijakan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_arah_kebijakan_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_arah_kebijakan->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_arah_kebijakan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// =======================================================================================================

	public function import_arah_kebijakan()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :

			$data = $this->opd_arah_kebijakan->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id])->findAll();
			foreach ($data as $key => $val) {
				$result[] = array(
					'opd_arah_kebijakan' => $data[$key]['opd_arah_kebijakan'],
					'opd_strategi_n' => $data[$key]['opd_strategi_n'],
					'opd_id' => user()->opd_id,
					'perubahan' => $_SESSION['perubahan'],
					'created_by' => user()->full_name,
				);
			}
			$this->opd_arah_kebijakan->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_arah_kebijakan');

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
