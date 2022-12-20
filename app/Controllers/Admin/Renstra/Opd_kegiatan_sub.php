<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_kegiatan_sub;
use App\Models\Admin\RPJMD\Model_tahun;

class Opd_kegiatan_sub extends BaseController
{
	protected $opd_kegiatan_sub, $tahun;

	public function __construct()
	{
		$this->opd_kegiatan_sub = new Model_opd_kegiatan_sub();
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
				return redirect()->to(base_url('/admin/renstra/opd_kegiatan_sub'));
			}

			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_kegiatan_sub',
				'title' => 'Admin | Sub kegiatan',
				'lok' => '<b>Sub Kegiatan</b>',
				'opd_kegiatan_sub' => $this->opd_kegiatan_sub->kegiatan_sub(),
				'opd' => $this->opd_kegiatan_sub->opd(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Renstra/opd_kegiatan_sub', $data);
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

		return redirect()->to(base_url('/admin/renstra/opd_kegiatan_sub'));
	}
}
