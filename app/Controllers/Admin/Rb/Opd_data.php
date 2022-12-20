<?php

namespace App\Controllers\Admin\Rb;

use App\Controllers\BaseController;
use App\Models\Admin\Rb\Model_rb_opd;
use App\Models\Admin\User\Model_bidang;

class Opd_data extends BaseController
{
	protected $opd;

	public function __construct()
	{
		$this->opd = new Model_bidang();
		$this->rb_opd = new Model_rb_opd();
	}

	public function index()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'rb-v',
				'mn' => 'opd',
				'title' => 'RB OPD',
				'lok' => '<b>OPD</b>',
				'opd' => $this->opd->notLike('auth_groups.id', '0001')->findAll(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rb/opd_data', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag($id)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'rb-v',
				'mn' => 'opd',
				'title' => 'RB OPD',
				'lok' => '<a onclick="history.back(-1)" href="#">OPD</a> -> <b>Tag</b>',
				'tag' => $this->rb_opd->find($id),
			];
			// dd($data);
			echo view('admin/Rb/opd_data_tag', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tag_create()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$this->rb_opd->save([
				'id_rb_opd' => $this->request->getVar('id'),
				'unit_utama' => $this->request->getVar('unit_utama')  == 'ya' ? 'ya' : 'tidak',
				'unit_pendukung' => $this->request->getVar('unit_pendukung')  == 'ya' ? 'ya' : 'tidak',
				'unit_tambahan' => $this->request->getVar('unit_tambahan')  == 'ya' ? 'ya' : 'tidak',
				'sempel' => $this->request->getVar('sempel') == 'ya' ? 'ya' : 'tidak',
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/Rb/opd_data');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
