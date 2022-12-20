<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;

class Arah_kebijakan extends BaseController
{
	public function index()
	{
		if (has_permission('Admin') || has_permission('User')) :
			$url = getenv('Api_Url') . "/api/rpjmd/arah-kebijakan";
			$response = akses_api('GET', $url, []);

			$data = [
				'gr' => 'rpjmd',
				'mn' => 'arah_kebijakan',
				'title' => 'Admin | Arah Kebijakan',
				'lok' => '<b>Arah Kebijakan</b>',
				'arah_kebijakan' => json_decode($response->getBody(), true),
			];
			echo view('admin/RPJMD/arah_kebijakan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
