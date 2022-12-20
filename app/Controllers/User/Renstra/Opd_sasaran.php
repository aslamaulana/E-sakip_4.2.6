<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_sasaran;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Renstra\Model_opd_sasaran;
use App\Models\Admin\RPJMD\Model_tahun;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_sasaran extends BaseController
{
	protected $opd_ujuan, $opd_sasaran, $satuan, $tahun, $opd_opd_sasaran_indik_target;

	public function __construct()
	{
		$this->tujuan = new Model_sasaran();
		$this->opd_sasaran = new Model_opd_sasaran();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<b>Sasaran</b>',
				'sasaran' => $this->opd_sasaran->sasaran(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_sasaran', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<a href=".">Sasaran</a> -> <b>Tambah Sasaran</b>',
				'satuan' => $this->satuan->satuan(),
				'opd_tujuan' => $this->opd_sasaran->getTujuan(),
				'rpjmd_sasaran' => $this->opd_sasaran->RpjmdSasaran(),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_sasaran_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([

				'rpjmd_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'indikator_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_sasaran->save([
				'rpjmd_sasaran_n' => $this->request->getVar('rpjmd_sasaran'),
				'opd_tujuan_n' => $this->request->getVar('tujuan'),
				'opd_sasaran' => preg_replace("/\r|\n/", "", $this->request->getVar('sasaran')),
				'opd_kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'opd_indikator_sasaran' => preg_replace("/\r|\n/", "", $this->request->getVar('indikator_sasaran')),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_edit()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$p = $_GET['p'];
			$k = $_GET['k'];
			$m = $_GET['m'];
			$o = $_GET['o'];
			$rs = $_GET['rs'];
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<a href=".">Sasaran</a> -> <b>Ubah Sasaran</b>',
				'opd_tujuan' => $this->opd_sasaran->getTujuan(),
				'sasaran' => $this->opd_sasaran->OpdSasaranEdit($p, $k, $m, $o, $rs),
				'rpjmd_sasaran' => $this->opd_sasaran->RpjmdSasaran(),
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
			echo view('user/Renstra/opd_sasaran_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_sasaran_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'tujuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$data = [
				'rpjmd_sasaran_n' => $this->request->getVar('rpjmd_sasaran'),
				'opd_tujuan_n' => $this->request->getVar('tujuan'),
				'opd_sasaran' => preg_replace("/\r|\n/", "", $this->request->getVar('sasaran')),
				'opd_kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'updated_by' => user()->full_name,
			];
			$dataw = [
				'rpjmd_sasaran_n' => $this->request->getVar('rpjmd_sasaran_old'),
				'opd_tujuan_n' => $this->request->getVar('tujuan_old'),
				'opd_kode_sasaran' => $this->request->getVar('kode_sasaran_old'),
				'opd_sasaran' => $this->request->getVar('sasaran_old'),
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => $this->request->getVar('opd_id')
			];
			$this->opd_sasaran->set($data)->where($dataw)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------

	public function opd_sasaran_indik_add($id = '')
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Tambah Indikator sasaran</b>',
				'validation' => \Config\Services::validation(),
				'sasaran' => $_GET['p'],
				'rpjmd_sasaran' => $_GET['r'],
				'kode_sasaran' => $_GET['k'],
				'opd_tujuan_n' => $_GET['m'],
				// 'opd_sasaran' => $this->opd_sasaran->find($id),
				'satuan' => $this->satuan->satuan(),
			];
			echo view('user/Renstra/opd_sasaran_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_indik_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_sasaran->save([
				'opd_tujuan_n' => $this->request->getVar('tujuan'),
				'rpjmd_sasaran_n' => $this->request->getVar('rpjmd_sasaran'),
				'opd_sasaran' => $this->request->getVar('sasaran'),
				'opd_kode_sasaran' => $this->request->getVar('kode_sasaran'),
				'opd_indikator_sasaran' => preg_replace("/\r|\n/", "", $this->request->getVar('indikator_sasaran')),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_indik_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Tambah Indikator sasaran</b>',
				'validation' => \Config\Services::validation(),
				'satuan' => $this->satuan->satuan(),
				'indikator' => $this->opd_sasaran->find($id),
			];
			echo view('user/Renstra/opd_sasaran_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_indik_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_sasaran->save([
				'id_opd_sasaran' => $this->request->getVar('id_sasaran'),
				'opd_indikator_sasaran' => preg_replace("/\r|\n/", "", $this->request->getVar('indikator_sasaran')),
				'satuan' => $this->request->getVar('satuan'),
				't_2021' => $this->request->getVar('t_2021'),
				't_2022' => $this->request->getVar('t_2022'),
				't_2023' => $this->request->getVar('t_2023'),
				't_2024' => $this->request->getVar('t_2024'),
				't_2025' => $this->request->getVar('t_2025'),
				't_2026' => $this->request->getVar('t_2026'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_sasaran_indik_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_sasaran->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_sasaran/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function import()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_sasaran',
				'title' => 'User | SASARAN',
				'lok' => '<a onclick="history.back(-1)" href="#">Sasaran</a> -> <b>Import Data</b>',
			];
			echo view('user/Renstra/opd_sasaran_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$sisw = $this->opd_sasaran->getTujuan();
		$rpjmd = $this->opd_sasaran->RpjmdSasaran();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Tujuan')
			->setCellValue('B1', 'Sasaran RPJMD')
			->setCellValue('C1', 'Sasaran')
			->setCellValue('D1', 'Kode Sasaran')
			->setCellValue('E1', 'Indikator Sasaran')
			->setCellValue('F1', 'Satuan')
			->setCellValue('G1', 't_2021')
			->setCellValue('H1', 't_2022')
			->setCellValue('I1', 't_2023')
			->setCellValue('J1', 't_2024')
			->setCellValue('K1', 't_2025')
			->setCellValue('L1', 't_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['opd_tujuan']);

			$column++;
		}

		$spreadsheet->getActiveSheet()->setTitle('Maping');
		// --------------------------------------------------------------
		$spreadsheet->createSheet();

		$spreadsheet->setActiveSheetIndex(1)
			->setCellValue('A1', 'Kode Sasaran RJMD')
			->setCellValue('B1', 'Sasaran RJMD');
		$col = 2;
		foreach ($rpjmd as $row) {
			$spreadsheet->setActiveSheetIndex(1)
				->setCellValue('A' . $col, $row['kode_sasaran'])
				->setCellValue('B' . $col, $row['sasaran']);

			$col++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Sasaran RPJMD');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Sasaran - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
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

		$data = $spreadsheet->setActiveSheetIndex(0)->toArray();
		foreach ($data as $x => $row) {
			if ($x == 0) {
				continue;
			}
			$simpandata = [
				'opd_tujuan_n' => preg_replace("/\r|\n/", "", $row[0]),
				'rpjmd_sasaran_n' => preg_replace("/\r|\n/", "", $row[1]),
				'opd_sasaran' => preg_replace("/\r|\n/", "", $row[2]),
				'opd_kode_sasaran' => $row[3],
				'opd_indikator_sasaran' => preg_replace("/\r|\n/", "", $row[4]),
				'satuan' => $row[5],
				't_2021' => $row[6],
				't_2022' => $row[7],
				't_2023' => $row[8],
				't_2024' => $row[9],
				't_2025' => $row[10],
				't_2026' => $row[11],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			];

			$this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_sasaran/');
	}
	// ----------------------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_sasaran->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->findAll();
		$rpjmd = $this->opd_sasaran->RpjmdSasaran();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Tujuan')
			->setCellValue('C1', 'Sasaran RPJMD')
			->setCellValue('D1', 'Sasaran')
			->setCellValue('E1', 'Kode Sasaran')
			->setCellValue('F1', 'Indikator Sasaran')
			->setCellValue('G1', 'Satuan')
			->setCellValue('H1', 't_2021')
			->setCellValue('I1', 't_2022')
			->setCellValue('J1', 't_2023')
			->setCellValue('K1', 't_2024')
			->setCellValue('L1', 't_2025')
			->setCellValue('M1', 't_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_sasaran'])
				->setCellValue('B' . $column, $sisdata['opd_tujuan_n'])
				->setCellValue('C' . $column, $sisdata['rpjmd_sasaran_n'])
				->setCellValue('D' . $column, $sisdata['opd_sasaran'])
				->setCellValue('E' . $column, $sisdata['opd_kode_sasaran'])
				->setCellValue('F' . $column, $sisdata['opd_indikator_sasaran'])
				->setCellValue('G' . $column, $sisdata['satuan'])
				->setCellValue('H' . $column, $sisdata['t_2021'])
				->setCellValue('I' . $column, $sisdata['t_2022'])
				->setCellValue('J' . $column, $sisdata['t_2023'])
				->setCellValue('K' . $column, $sisdata['t_2024'])
				->setCellValue('L' . $column, $sisdata['t_2025'])
				->setCellValue('M' . $column, $sisdata['t_2026']);


			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');
		// --------------------------------------------------------------
		$spreadsheet->createSheet();

		$spreadsheet->setActiveSheetIndex(1)
			->setCellValue('A1', 'Kode Sasaran RJMD')
			->setCellValue('B1', 'Sasaran RJMD');
		$col = 2;
		foreach ($rpjmd as $row) {
			$spreadsheet->setActiveSheetIndex(1)
				->setCellValue('A' . $col, $row['kode_sasaran'])
				->setCellValue('B' . $col, $row['sasaran']);

			$col++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Sasaran RPJMD');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Sasaran-Edit-' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
	public function simpanExcel_edit()
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
			$simpandata = [
				'opd_tujuan_n' => preg_replace("/\r|\n/", "", $row[1]),
				'rpjmd_sasaran_n' => preg_replace("/\r|\n/", "", $row[2]),
				'opd_sasaran' => preg_replace("/\r|\n/", "", $row[3]),
				'opd_kode_sasaran' => $row[4],
				'opd_indikator_sasaran' => preg_replace("/\r|\n/", "", $row[5]),
				'satuan' => $row[6],
				't_2021' => $row[7],
				't_2022' => $row[8],
				't_2023' => $row[9],
				't_2024' => $row[10],
				't_2025' => $row[11],
				't_2026' => $row[12],
				'updated_by' => user()->full_name,
			];
			$id = [
				'id_opd_sasaran' => $row[0],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
			];
			$this->opd_sasaran->set($simpandata)->where($id)->update();

			// $this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_sasaran/');
	}
	// ===========================================Perubahan=====================================
	public function export_perubahan()
	{
		$sisw = $this->opd_sasaran->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id])->findAll();
		$rpjmd = $this->opd_sasaran->RpjmdSasaran();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Tujuan')
			->setCellValue('B1', 'Sasaran RPJMD')
			->setCellValue('C1', 'Sasaran')
			->setCellValue('D1', 'Kode Sasaran')
			->setCellValue('E1', 'Indikator Sasaran')
			->setCellValue('F1', 'Satuan')
			->setCellValue('G1', 't_2021')
			->setCellValue('H1', 't_2022')
			->setCellValue('I1', 't_2023')
			->setCellValue('J1', 't_2024')
			->setCellValue('K1', 't_2025')
			->setCellValue('L1', 't_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['opd_tujuan_n'])
				->setCellValue('B' . $column, $sisdata['rpjmd_sasaran_n'])
				->setCellValue('C' . $column, $sisdata['opd_sasaran'])
				->setCellValue('D' . $column, $sisdata['opd_kode_sasaran'])
				->setCellValue('E' . $column, $sisdata['opd_indikator_sasaran'])
				->setCellValue('F' . $column, $sisdata['satuan'])
				->setCellValue('G' . $column, $sisdata['t_2021'])
				->setCellValue('H' . $column, $sisdata['t_2022'])
				->setCellValue('I' . $column, $sisdata['t_2023'])
				->setCellValue('J' . $column, $sisdata['t_2024'])
				->setCellValue('K' . $column, $sisdata['t_2025'])
				->setCellValue('L' . $column, $sisdata['t_2026']);

			$column++;
		}

		$spreadsheet->getActiveSheet()->setTitle('Maping');
		// --------------------------------------------------------------
		$spreadsheet->createSheet();

		$spreadsheet->setActiveSheetIndex(1)
			->setCellValue('A1', 'Kode Sasaran RJMD')
			->setCellValue('B1', 'Sasaran RJMD');
		$col = 2;
		foreach ($rpjmd as $row) {
			$spreadsheet->setActiveSheetIndex(1)
				->setCellValue('A' . $col, $row['kode_sasaran'])
				->setCellValue('B' . $col, $row['sasaran']);

			$col++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Sasaran RPJMD');

		$writer = new Xlsx($spreadsheet);
		$filename = 'Sasaran RENSTRA Murni - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
