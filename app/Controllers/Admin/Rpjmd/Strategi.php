<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;

class Strategi extends BaseController
{
	public function index()
	{
		if (has_permission('Admin') || has_permission('User')) :
			$url = getenv('Api_Url') . "/api/rpjmd/strategi";
			$response = akses_api('GET', $url, []);

			$data = [
				'gr' => 'rpjmd',
				'mn' => 'strategi',
				'title' => 'Admin | STRATEGI',
				'lok' => '<b>Strategi</b>',
				'strategi' => json_decode($response->getBody(), true),
			];
			echo view('admin/RPJMD/strategi', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
