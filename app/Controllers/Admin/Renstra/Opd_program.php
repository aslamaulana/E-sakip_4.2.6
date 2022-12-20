<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_program;
use App\Models\Admin\RPJMD\Model_tahun;

class Opd_program extends BaseController
{
	protected $opd_program, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_program = new Model_opd_program();
		$this->tahun = new Model_tahun();

		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			if (!isset($_SESSION['opd_set'])) {
				try {
					$this->session->set('opd_set', '0002');
				} catch (\Exception $e) {
				}
				return redirect()->to(base_url('/admin/renstra/opd_program'));
			}

			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_program',
				'title' => 'Admin | Program',
				'lok' => '<b>Program</b>',
				// 'opd_program_sasaran' => $this->opd_program->ProgramSasaran(),
				'opd_program' => $this->opd_program->program(),
				'opd' => $this->opd_program->opd(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Renstra/opd_program', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/*
	 * ---------------------------------------------------
	 * Set Opd
	 * ---------------------------------------------------
	 */
	public function opd($opd)
	{
		$this->session->set('opd_set', $opd);

		return redirect()->to(base_url('/admin/renstra/opd_program'));
	}
}
