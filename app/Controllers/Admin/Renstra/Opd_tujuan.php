<?php

namespace App\Controllers\Admin\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\Renstra\Model_opd_tujuan;
use App\Models\Admin\RPJMD\Model_tahun;

class Opd_tujuan extends BaseController
{
	protected $visi, $misi, $tujuan, $satuan, $tahun, $tujuan_indik_target;

	public function __construct()
	{
		// $this->visi = new Model_visi();
		$this->opd_tujuan = new Model_opd_tujuan();
		$this->tahun = new Model_tahun();

		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (has_permission('Admin')) {
			if (!isset($_SESSION['opd_set'])) {
				try {
					$this->session->set('opd_set', '0002');
				} catch (\Exception $e) {
				}
				return redirect()->to(base_url('/admin/renstra/opd_tujuan'));
			}
			$data = [
				'gr' => 'A_Renstra',
				'mn' => 'A_opd_tujuan',
				'title' => 'User | OPD TUJUAN',
				'lok' => '<b>Tujuan</b>',
				'tahunA' => $this->tahun->tahunA(),
				'opd_tujuan' => $this->opd_tujuan->tujuan(),
				'opd' => $this->opd_tujuan->opd(),
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			return view('admin/Renstra/opd_tujuan', $data);
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	/*
	 * ---------------------------------------------------
	 * Set Opd
	 * ---------------------------------------------------
	 */
	public function opd($opd)
	{
		$this->session->set('opd_set', $opd);

		return redirect()->to(base_url('/admin/renstra/opd_tujuan'));
	}
}
