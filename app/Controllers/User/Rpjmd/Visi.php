<?php

namespace App\Controllers\User\Rpjmd;

use App\Controllers\BaseController;

class Visi extends BaseController
{
	public function index()
	{
		if (has_permission('Admin') || has_permission('User')) :

			$url = getenv('Api_Url') . "/api/rpjmd/visi";
			$response = akses_api('GET', $url, []);

			$data = [
				'gr' => 'rpjmd',
				'mn' => 'visi',
				'title' => 'VISI / MISI',
				'lok' => '<b>Visi</b>',
				'visi' => json_decode($response->getBody(), true),
			];
			echo view('admin/RPJMD/visi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
