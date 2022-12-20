<?php

namespace App\Controllers\User\Emonev;

use App\Controllers\BaseController;
use App\Models\User\Dpa\Model_dpa;
use App\Models\User\Emonev\Model_emonev_progres;
use App\Models\User\Emonev\Model_emonev_progres_indikator;

class Emonev extends BaseController
{
	protected $dpa, $emonev;
	public function __construct()
	{
		$this->dpa = new Model_dpa();
		$this->emonev = new Model_emonev_progres();
		$this->emonev_indikator = new Model_emonev_progres_indikator();
	}
	public function index()
	{
		if (has_permission('User')) :
			$dpa = $this->dpa->dpa_program();
			$data = [
				'gr' => 'emonev',
				'mn' => 'e_progres',
				'title' => 'User | Emonev',
				'lok' => '<b>Emonev</b>',
				'dpa' => $dpa,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Emonev/emonev', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres($id)
	{
		if (has_permission('User')) :
			$emonev_program = $this->dpa->emonev_program($id);
			$data = [
				'gr' => 'emonev',
				'mn' => 'e_progres',
				'title' => 'User | Emonev',
				'lok' => '<b>Emonev</b>',
				'db' => \Config\Database::connect(),
				'dpa_id' => $id,
				'emonev_program' => $emonev_program,
			];
			echo view('user/Emonev/emonev_progres', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres_add($id, $b, $bulan)
	{
		if (has_permission('User')) :
			$emonev_program = $this->dpa->emonev_program($id);
			$data = [
				'gr' => 'emonev',
				'mn' => 'e_progres',
				'title' => 'User | Emonev',
				'lok' => '<a onclick="history.back(-1)" href="#">Emonev</a> -> <b>Input Progres</b>',
				'db' => \Config\Database::connect(),
				'dpa_id' => $id,
				'b' => $b,
				'bulan' => $bulan,
				'emonev_program' => $emonev_program,
			];
			echo view('user/Emonev/emonev_progres_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres_create()
	{
		if (has_permission('User')) :
			$this->emonev->save([
				'dpa_id' => $this->request->getVar('dpa_id'),
				'bulan' => $this->request->getVar('bulan'),
				'tahap_pekerjaan_fisik' => $this->request->getVar('tahap_fisik'),
				'faktor_pendukung' => $this->request->getVar('pendukung'),
				'faktor_penghambat' => $this->request->getVar('penghambat'),
				'realisasi_keu' => $this->request->getVar('keu'),
				'realisasi_fisik' => $this->request->getVar('fis'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'bulan_lapor' => date('m'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/emonev/emonev/progres/' . $this->request->getVar('dpa_id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres_edit($id, $b, $bulan)
	{
		if (has_permission('User')) :
			$emonev_program = $this->dpa->emonev_program($id);
			$progres = $this->emonev->progres_edit($b);
			$data = [
				'gr' => 'emonev',
				'mn' => 'e_progres',
				'title' => 'User | Emonev',
				'lok' => '<a onclick="history.back(-1)" href="#">Emonev</a> -> <b>Ubah Progres</b>',
				'db' => \Config\Database::connect(),
				'dpa_id' => $id,
				'progres_id' => $progres,
				'bulan' => $bulan,
				'emonev_program' => $emonev_program,
			];
			echo view('user/Emonev/emonev_progres_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres_update()
	{
		if (has_permission('User')) :
			$this->emonev->save([
				'id_emonev_progres' => $this->request->getVar('id_progres'),
				'tahap_pekerjaan_fisik' => $this->request->getVar('tahap_fisik'),
				'faktor_pendukung' => $this->request->getVar('pendukung'),
				'faktor_penghambat' => $this->request->getVar('penghambat'),
				'realisasi_keu' => $this->request->getVar('keu'),
				'realisasi_fisik' => $this->request->getVar('fis'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/emonev/emonev/progres/' . $this->request->getVar('dpa_id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ----------------------------------------------------------------------------
	public function progres_indikator_add($id, $b, $bulan)
	{
		if (has_permission('User')) :
			$emonev_program = $this->dpa->emonev_program($id);
			$data = [
				'gr' => 'emonev',
				'mn' => 'e_progres',
				'title' => 'User | Emonev',
				'lok' => '<a onclick="history.back(-1)" href="#">Emonev</a> -> <b>Input indikator</b>',
				'db' => \Config\Database::connect(),
				'dpa_id' => $id,
				'b' => $b,
				'bulan' => $bulan,
				'emonev_program' => $emonev_program,
			];
			echo view('user/Emonev/emonev_progres_indikator_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres_indikator_create()
	{
		if (has_permission('User')) :

			foreach ($_POST['id_dpa_indikator'] as $key => $val) {
				$result[] = array(
					'dpa_indikator_id' => $_POST['id_dpa_indikator'][$key],
					'bulan' => $this->request->getVar('bulan'),
					'bulan_lapor' => date('m'),
					'realisasi_dpa_indikator' => $_POST['realisasi'][$key],
					'opd_id' => user()->opd_id,
					'tahun' => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				);
			}

			$this->emonev_indikator->insertBatch($result);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/emonev/emonev/progres/' . $this->request->getVar('dpa_id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres_indikator_edit($id, $b, $bulan)
	{
		if (has_permission('User')) :
			$emonev_program = $this->dpa->emonev_program($id);
			$data = [
				'gr' => 'emonev',
				'mn' => 'e_progres',
				'title' => 'User | Emonev',
				'lok' => '<a onclick="history.back(-1)" href="#">Emonev</a> -> <b>ubah indikator</b>',
				'db' => \Config\Database::connect(),
				'dpa_id' => $id,
				'b' => $b,
				'bulan' => $bulan,
				'emonev_program' => $emonev_program,
			];
			echo view('user/Emonev/emonev_progres_indikator_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function progres_indikator_update()
	{
		if (has_permission('User')) :

			foreach ($_POST['id_emonev_progres_indikator'] as $key => $val) {
				$result[] = array(
					'id_emonev_progres_indikator' => $_POST['id_emonev_progres_indikator'][$key],
					'realisasi_dpa_indikator' => $_POST['realisasi'][$key],
					'updated_by' => user()->full_name,
				);
			}
			$this->emonev_indikator->updateBatch($result, 'id_emonev_progres_indikator');

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/emonev/emonev/progres/' . $this->request->getVar('dpa_id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	//-----------------------------------------------------------------------------------------------------
}
