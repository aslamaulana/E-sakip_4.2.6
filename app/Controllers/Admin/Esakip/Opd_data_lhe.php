<?php

namespace App\Controllers\Admin\Esakip;

use App\Controllers\BaseController;
use App\Models\Admin\Esakip\Model_sakip_opd;
use App\Models\Admin\User\Model_bidang;

class Opd_data_lhe extends BaseController
{
	protected $opd;

	public function __construct()
	{
		$this->opd = new Model_bidang();
		$this->sakip_opd = new Model_sakip_opd();
	}

	public function index()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'esakip-v',
				'mn' => 'a-instansi-lhe',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<b>SAKIP-LKE-Instansi</b>',
				'opd' => $this->opd->notLike('auth_groups.id', '0001')->findAll(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Esakip/opd_data_lhe', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag($id)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'esakip-v',
				'mn' => 'a-instansi',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<a onclick="history.back(-1)" href="#">SAKIP-LKE-Instansi</a> -> <b>Tag</b>',
				'tag' => $this->sakip_opd->find($id),
			];
			// dd($data);
			echo view('admin/Esakip/opd_data_tag', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag_create()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$this->sakip_opd->save([
				'id_sakip_opd' => $this->request->getVar('id'),
				'unit_utama' => $this->request->getVar('unit_utama')  == 'ya' ? 'ya' : 'tidak',
				'unit_pendukung' => $this->request->getVar('unit_pendukung')  == 'ya' ? 'ya' : 'tidak',
				'unit_tambahan' => $this->request->getVar('unit_tambahan')  == 'ya' ? 'ya' : 'tidak',
				'sempel' => $this->request->getVar('sempel') == 'ya' ? 'ya' : 'tidak',
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/esakip/opd_data');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
