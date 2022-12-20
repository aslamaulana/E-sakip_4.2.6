<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_tahun;

class Opd_program extends BaseController
{
	protected $opd_program, $satuan, $tahun;

	public function __construct()
	{
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :

			$url = getenv('Api_Url') . "/api/renstra/program/" . $_SESSION['perubahan'] . '/' . user()->opd_id;
			$response = akses_api('GET', $url, []);

			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program',
				'title' => 'User | Program',
				'lok' => '<b>Program</b>',
				// 'opd_program_sasaran' => $this->opd_program->ProgramSasaran(),
				'opd_program' => json_decode($response->getBody(), true),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			// print_r($response->getBody());

			echo view('user/Renstra/opd_program', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
