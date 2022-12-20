<?php

namespace App\Controllers\Admin\Esakip;

use App\Controllers\BaseController;
use App\Models\User\Esakip\Model_sakip_instansi;
use App\Models\admin\Esakip\Model_sakip_instansi_jawaban_lhe;
use App\Models\admin\Esakip\Model_sakip_instansi_jawaban_verifikasi_lhe;

class Sakip_instansi_nilai_lhe extends BaseController
{
	protected $sakip;

	public function __construct()
	{
		$this->sakip = new Model_sakip_instansi();
		$this->jawaban = new Model_sakip_instansi_jawaban_lhe();
		$this->verifikasi = new Model_sakip_instansi_jawaban_verifikasi_lhe();
	}
	public function index()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'esakip-v',
				'mn' => 'a-instansi_nilai',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<b>SAKIP-LKE-GAB</b>',
				'sakip' => $this->sakip->sakip_instansi()->getWhere(['tb_sakip_instansi.tahun' => $_SESSION['tahun']])->getResultArray(),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('admin/Esakip/sakip_instansi_nilai', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
