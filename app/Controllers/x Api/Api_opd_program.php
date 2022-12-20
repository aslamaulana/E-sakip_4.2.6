<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\Api\Model_renstra_program;


class Api_opd_program extends BaseController
{
	protected $opd_program, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_program = new Model_renstra_program();
	}
	public function program($perubahan)
	{
		echo json_encode($this->opd_program->Api_program($perubahan));
	}
	public function program_opd($perubahan, $opd_id = '')
	{
		echo json_encode($this->opd_program->Api_program_opd($perubahan, $opd_id));
	}
	public function show_data($data)
	{
		$url = 'http://36.95.117.13:8080/api/program/' . $data . '/';
		$get_url = file_get_contents($url);
		// $data1 = json_decode($get_url);

		$data = [
			'gr' => 'Renstra',
			'mn' => 'opd_program',
			'title' => 'User | Program',
			'lok' => '<b>Program</b>',
			// 'opd_program_sasaran' => $this->opd_program->ProgramSasaran(),
			// 'opd_program' => $this->opd_program->program(),
			'opd_program' => json_decode($get_url, true),
			'tahunA' => $this->tahun->tahunA(),
			'db' => \Config\Database::connect(),
		];
		// dd($data);
		echo view('user/Renstra/opd_program', $data);
	}
	public function show_data_opd($data, $opd_id)
	{
		$url = 'http://36.95.117.13:8080/api/program_opd/' . $data . '/' . $opd_id;
		$get_url = file_get_contents($url);
		// $data1 = json_decode($get_url);

		$data = [
			'gr' => 'Renstra',
			'mn' => 'opd_program',
			'title' => 'User | Program',
			'lok' => '<b>Program</b>',
			// 'opd_program_sasaran' => $this->opd_program->ProgramSasaran(),
			// 'opd_program' => $this->opd_program->program(),
			'opd_program' => json_decode($get_url, true),
			'tahunA' => $this->tahun->tahunA(),
			'db' => \Config\Database::connect(),
		];
		// dd($data);
		echo view('user/Renstra/opd_program', $data);
	}
}
