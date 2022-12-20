<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_tahun;

class Tujuan extends BaseController
{
	protected $tahun;

	public function __construct()
	{
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('Admin') || has_permission('User')) :
			$url = getenv('Api_Url') . "/api/rpjmd/tujuan";
			$response = akses_api('GET', $url, []);

			$data = [
				'gr' => 'rpjmd',
				'mn' => 'tujuan',
				'title' => 'Admin | TUJUAN',
				'lok' => '<b>Tujuan</b>',
				'tujuan' => json_decode($response->getBody(), true),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/tujuan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
