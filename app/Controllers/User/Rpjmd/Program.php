<?php

namespace App\Controllers\Admin\Rpjmd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_sasaran;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\Admin\RPJMD\Model_program;
use App\Models\Admin\RPJMD\Model_tahun;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\RPJMD\Model_bidang_90;
use App\Models\Admin\RPJMD\Model_urusan_90;
use App\Models\Admin\RPJMD\Model_program_90;

class Program extends BaseController
{
	protected $sasaran, $program, $satuan, $tahun, $program_indik_target, $opd, $bidang_90, $urusan_90, $program_90;

	public function __construct()
	{
		$this->sasaran = new Model_sasaran();
		$this->program = new Model_program();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
		$this->opd = new Model_bidang();
		$this->bidang_90 = new Model_bidang_90();
		$this->urusan_90 = new Model_urusan_90();
		$this->program_90 = new Model_program_90();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			$tahunA = $this->tahun->tahunA();
			$sasaran = $this->program->sasaran();
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'program',
				'title' => 'Admin | Program',
				'lok' => '<b>Program</b>',
				'sasaran' => $sasaran,
				'tahunA' => $tahunA,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/program', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function AmbilBidang()
	{
		$urusan = $this->request->getVar('urusan');
		$data = $this->program->getBidang($urusan);

		echo json_encode($data);
	}
	public function AmbilProgram()
	{
		$bidang = $this->request->getVar('bidang');
		$data = $this->program->getProgram($bidang);

		echo json_encode($data);
	}
	public function program_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'program',
				'title' => 'Admin | Program',
				'lok' => '<a href=".">Program</a> -> <b>Tambah Program</b>',
				'sasaran' => $this->program->getSasaran(),
				'satuan' => $this->satuan->satuan(),
				'opd' => $this->opd->Groups(),
				'urusan' => $this->urusan_90->Urusan(),
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/program_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function program_create()
	{
		if (has_permission('Admin')) :

			$this->program->save([
				'urusan_90' => $this->request->getVar('urusan'),
				'bidang_90' => $this->request->getVar('bidang'),
				'program_90' => $this->request->getVar('program'),
				'sasaran_n' => $this->request->getVar('sasaran'),
				'indikator_program'  => $this->request->getVar('indikator_program'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				'rp_2021' => $this->request->getVar('rp_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				'rp_2022' => $this->request->getVar('rp_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				'rp_2023' => $this->request->getVar('rp_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				'rp_2024' => $this->request->getVar('rp_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				'rp_2025' => $this->request->getVar('rp_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'rp_2026' => $this->request->getVar('rp_2026'),
				'opd_id' => $this->request->getVar('opd'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function program_edit()
	{
		if (has_permission('Admin')) :
			$get = [
				'urusan' => $_GET['u'],
				'bidang' =>  $_GET['b'],
				'program' =>  $_GET['p'],
				'sasaran' =>  $_GET['s'],
				'kode' =>  $_GET['k'],
				'opd' =>  $_GET['o'],
			];
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'program',
				'title' => 'Admin | Program',
				'lok' => '<a href="/admin/rpjmd/program">Program</a> -> <b>Ubah Program</b>',
				'program' => $get,
				'sasaran' => $this->program->getSasaran(),
				'opd' => $this->opd->Groups(),
				'opd2' => $this->opd->find($_GET['o']),
				'validation' => \Config\Services::validation(),
			];
			echo view('admin/RPJMD/program_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function program_update()
	{
		if (has_permission('Admin')) :

			$data = [
				'sasaran_n' => $this->request->getVar('sasaran'),
				'opd_id' => $this->request->getVar('opd'),
				'updated_by' => user()->full_name,
			];

			$dataw = [
				'urusan_90' => $this->request->getVar('urusan_old'),
				'bidang_90' => $this->request->getVar('bidang_old'),
				'program_90' => $this->request->getVar('program_old'),
				'sasaran_n' => $this->request->getVar('sasaran_old'),
				'opd_id' => $this->request->getVar('opd_old'),
			];

			$this->program->set($data)->where($dataw)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------

	public function program_indik_add()
	{
		if (has_permission('Admin')) :
			$get = [
				'urusan' => $_GET['u'],
				'bidang' =>  $_GET['b'],
				'program' =>  $_GET['p'],
				'sasaran' =>  $_GET['s'],
				'kode' =>  $_GET['k'],
				'opd' =>  $_GET['o'],
			];
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'program',
				'title' => 'Admin | Program',
				'lok' => '<a onclick="history.back(-1)" href="#">Program</a> -> <b>Tambah Indikator Program</b>',
				'validation' => \Config\Services::validation(),
				'program' => $get,
				'satuan' =>  $this->satuan->findAll(),
				'tahunA' => $this->tahun->tahunA(),
				// 'tahunT' => $this->tahun->tahunT()
			];
			echo view('admin/RPJMD/program_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function program_indik_create()
	{
		if (has_permission('Admin')) :

			$this->program->save([
				'urusan_90' => $this->request->getVar('urusan'),
				'bidang_90' => $this->request->getVar('bidang'),
				'program_90' => $this->request->getVar('program'),
				'sasaran_n' => $this->request->getVar('sasaran'),
				'indikator_program'  => $this->request->getVar('indikator_program'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				'rp_2021' => $this->request->getVar('rp_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				'rp_2022' => $this->request->getVar('rp_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				'rp_2023' => $this->request->getVar('rp_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				'rp_2024' => $this->request->getVar('rp_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				'rp_2025' => $this->request->getVar('rp_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'rp_2026' => $this->request->getVar('rp_2026'),
				'opd_id' => $this->request->getVar('opd'),
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function program_indik_edit($id)
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'program',
				'title' => 'Admin | Program',
				'lok' => '<a onclick="history.back(-1)" href="#">Program</a> -> <b>Ubah Indikator Program</b>',
				'validation' => \Config\Services::validation(),
				'program' => $this->program->find($id),
				'satuan' =>  $this->satuan->findAll(),
				'tahunA' => $this->tahun->tahunA(),
				// 'tahunT' => $this->tahun->tahunT()
			];
			echo view('admin/RPJMD/program_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function program_indik_update()
	{
		if (has_permission('Admin')) :

			$this->program->save([
				'id_program' => $this->request->getVar('id_program'),
				'indikator_program'  => $this->request->getVar('indikator_program'),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				'rp_2021' => $this->request->getVar('rp_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				'rp_2022' => $this->request->getVar('rp_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				'rp_2023' => $this->request->getVar('rp_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				'rp_2024' => $this->request->getVar('rp_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				'rp_2025' => $this->request->getVar('rp_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'rp_2026' => $this->request->getVar('rp_2026'),
				'updared_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/rpjmd/program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function program_indik_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->program->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/rpjmd/program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function import()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'rpjmd',
				'mn' => 'program',
				'title' => 'Admin | Program',
				'lok' => '<a onclick="history.back(-1)" href="#">Program</a> -> <b>Import Program</b>',
				'db' => \Config\Database::connect(),
			];
			echo view('admin/RPJMD/program_excel', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function simpanExcel()
	{
		$file_excel = $this->request->getFile('fileexcel');
		$ext = $file_excel->getClientExtension();
		if ($ext == 'xls') {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet = $render->load($file_excel);

		$data = $spreadsheet->getActiveSheet()->toArray();
		foreach ($data as $x => $row) {
			if ($x == 0) {
				continue;
			}

			// $Nis = $row[0];
			// $NamaSiswa = $row[1];
			// $Alamat = $row[2];

			// $db = \Config\Database::connect();

			// $cekNis = $db->table('siswa')->getWhere(['Nis' => $Nis])->getResult();

			// if (count($cekNis) > 0) {
			// 	session()->setFlashdata('message', '<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
			// } else {

			$simpandata = [
				'sasaran_n' => $row[0],
				'urusan_90' => $row[1],
				'bidang_90' => $row[2],
				'program_90' => $row[3],
				'indikator_program'  => $row[4],
				'satuan' => $row[5],
				't_2021' => $row[6],
				'rp_2021' => $row[7],
				't_2022' => $row[8],
				'rp_2022' => $row[9],
				't_2023' => $row[10],
				'rp_2023' => $row[11],
				't_2024' => $row[12],
				'rp_2024' => $row[13],
				't_2025' => $row[14],
				'rp_2025' => $row[15],
				't_2026' => $row[16],
				'rp_2026' => $row[17],
				'opd_id' => $row[18],
				// 'created_by' => user()->full_name,
			];

			$this->program->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/admin/rpjmd/program/');
	}
	// public function simpanExcel()
	// {
	// 	$file_excel = $this->request->getFile('fileexcel');
	// 	$ext = $file_excel->getClientExtension();
	// 	if ($ext == 'xls') {
	// 		$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
	// 	} else {
	// 		$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	// 	}
	// 	$spreadsheet = $render->load($file_excel);

	// 	$data = $spreadsheet->getActiveSheet()->toArray();
	// 	foreach ($data as $x => $row) {
	// 		if ($x == 0) {
	// 			continue;
	// 		}

	// 		$Nis = $row[0];
	// 		$NamaSiswa = $row[1];
	// 		$Alamat = $row[2];

	// 		$db = \Config\Database::connect();

	// 		$cekNis = $db->table('siswa')->getWhere(['Nis' => $Nis])->getResult();

	// 		if (count($cekNis) > 0) {
	// 			session()->setFlashdata('message', '<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
	// 		} else {

	// 			$simpandata = [
	// 				'Nis' => $Nis, 'NamaSiswa' => $NamaSiswa, 'Alamat' => $Alamat
	// 			];

	// 			$db->table('siswa')->insert($simpandata);
	// 			session()->setFlashdata('message', 'Berhasil import excel');
	// 		}
	// 	}

	// 	return redirect()->to('/siswa');
	// }
}
