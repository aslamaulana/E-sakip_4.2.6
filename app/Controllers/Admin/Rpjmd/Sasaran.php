<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_tahun;

class Sasaran extends BaseController
{
	protected $tahun;

	public function __construct()
	{
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('Admin') || has_permission('User')) :
			$url = getenv('Api_Url') . "/api/rpjmd/sasaran";
			$response = akses_api('GET', $url, []);

			$data = [
				'gr' => 'rpjmd',
				'mn' => 'sasaran',
				'title' => 'Admin | SASARAN',
				'lok' => '<b>Sasaran</b>',
				'sasaran' => json_decode($response->getBody(), true),
				'tahunA' => $this->tahun->tahunA(),
				// 'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('admin/RPJMD/sasaran', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
