<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_sasaran;
use App\Models\Admin\RPJMD\Model_tahun;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_sasaran extends BaseController
{
	protected $opd_ujuan, $opd_sasaran, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_sasaran = new Model_opd_sasaran();
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
				return redirect()->to(base_url('/admin/renstra/opd_sasaran'));
			}

			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<b>Sasaran</b>',
				'sasaran' => $this->opd_sasaran->sasaran(),
				'opd' => $this->opd_sasaran->opd(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Renstra/opd_sasaran', $data);
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

		return redirect()->to(base_url('/admin/renstra/opd_sasaran'));
	}
}
