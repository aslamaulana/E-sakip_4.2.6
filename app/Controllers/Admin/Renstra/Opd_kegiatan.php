<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_kegiatan;
use App\Models\Admin\RPJMD\Model_tahun;

class Opd_kegiatan extends BaseController
{
	protected $opd_kegiatan, $tahun;

	public function __construct()
	{
		$this->opd_kegiatan = new Model_opd_kegiatan();
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
				return redirect()->to(base_url('/admin/renstra/opd_kegiatan'));
			}

			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_kegiatan',
				'title' => 'Admin | Kegiatan',
				'lok' => '<b>Kegiatan</b>',
				'opd_kegiatan' => $this->opd_kegiatan->kegiatan(),
				'opd' => $this->opd_kegiatan->opd(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Renstra/opd_kegiatan', $data);
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

		return redirect()->to(base_url('/admin/renstra/opd_kegiatan'));
	}
}
