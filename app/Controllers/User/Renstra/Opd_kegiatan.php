<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Renstra\Model_opd_kegiatan;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_kegiatan extends BaseController
{
	protected $opd_kegiatan, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_kegiatan = new Model_opd_kegiatan();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan',
				'title' => 'User | Kegiatan',
				'lok' => '<b>Kegiatan</b>',
				'opd_kegiatan' => $this->opd_kegiatan->kegiatan(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_kegiatan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ambilopdkegiatan()
	{
		$program = $this->request->getVar('id');
		$data = $this->opd_kegiatan->getKegiatan($program);

		echo json_encode($data);
	}
	public function opd_kegiatan_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan',
				'title' => 'User | Kegiatan',
				'lok' => '<a href=".">Kegiatan</a> -> <b>Tambah Kegiatan</b>',
				'opd_program' => $this->opd_kegiatan->getOpdProgram(),
				// 'opd_kegiatan_sasaran' => $this->opd_kegiatan->getKegiatanSasaran(),
				// 'opd_kegiatan' => $this->opd_kegiatan->getProgram(),
				'satuan' => $this->satuan->satuan(),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_kegiatan_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'opd_kegiatan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'opd_kegiatan_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'opd_program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'indikator_kegiatan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan->save([
				'opd_program_n' => $this->request->getVar('opd_program'),
				'opd_kegiatan_sasaran_n' => $this->request->getVar('opd_kegiatan_sasaran'),
				'opd_kegiatan_n' => $this->request->getVar('opd_kegiatan'),
				'opd_indikator_kegiatan' => $this->request->getVar('indikator_kegiatan'),
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
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_edit()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan',
				'title' => 'User | Kegiatan',
				'lok' => '<a href=".">Kegiatan</a> -> <b>Tambah Kegiatan</b>',
				'opd_program' => $this->opd_kegiatan->getOpdProgram(),
				// 'opd_kegiatan_sasaran' => $this->opd_kegiatan->getKegiatanSasaran(),
				// 'opd_kegiatan' => $this->opd_kegiatan->getkegiatan(),
				'kegiatan' => $_GET['p'],
				'program' => $_GET['a'],
				'kegiatan_sasaran' => $_GET['m'],
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_kegiatan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'opd_program' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'opd_kegiatan_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'opd_kegiatan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$data = [
				'opd_kegiatan_n' => $this->request->getVar('opd_kegiatan'),
				'opd_kegiatan_sasaran_n' => $this->request->getVar('opd_kegiatan_sasaran'),
				'opd_program_n' => $this->request->getVar('opd_program'),
				'updated_by' => user()->full_name,
			];
			// dd($data);
			$dataw = [
				'opd_kegiatan_n' => $this->request->getVar('kegiatan_old'),
				'opd_kegiatan_sasaran_n' => $this->request->getVar('kegiatan_sasaran_old'),
				'opd_program_n' => $this->request->getVar('program_old'),
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
			];
			$this->opd_kegiatan->set($data)->where($dataw)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------

	public function opd_kegiatan_indik_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan',
				'title' => 'User | Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">Kegiatan</a> -> <b>Tambah Indikator Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'satuan' => $this->satuan->satuan(),
				'kegiatan' => $_GET['p'],
				'program' => $_GET['a'],
				'kegiatan_sasaran' => $_GET['m'],
			];
			echo view('user/Renstra/opd_kegiatan_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_indik_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_kegiatan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan->save([
				'opd_program_n' => $this->request->getVar('program'),
				'opd_kegiatan_sasaran_n' => $this->request->getVar('kegiatan_sasaran'),
				'opd_kegiatan_n' => $this->request->getVar('kegiatan'),
				'opd_indikator_kegiatan' => $this->request->getVar('indikator_kegiatan'),
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
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_indik_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan',
				'title' => 'User | Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">Kegiatan</a> -> <b>Tambah Indikator Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'indik' => $this->opd_kegiatan->find($id),
				'satuan' => $this->satuan->satuan(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_kegiatan_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_indik_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_kegiatan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan->save([
				'id_opd_kegiatan' => $this->request->getVar('id'),
				'opd_indikator_kegiatan' => $this->request->getVar('indikator_kegiatan'),
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
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_indik_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_kegiatan->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan/');
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
				'mn' => 'opd_kegiatan',
				'title' => 'User | Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">Kegiatan</a> -> <b>Import Data</b>',
			];
			echo view('user/Renstra/opd_kegiatan_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->opd_kegiatan->getKegiatanExport();
		// $data2 = $this->opd_kegiatan->getKegiatanSasaran();

		$spreadsheet = new Spreadsheet();
		// --------------------------------------------------------------
		$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Program')
			->setCellValue('B1', 'Kegiatan')
			->setCellValue('C1', 'Sasaran Kegiatan')
			->setCellValue('D1', 'Indikator Kegiatan')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 't_2021')
			->setCellValue('G1', 't_2022')
			->setCellValue('H1', 't_2023')
			->setCellValue('I1', 't_2024')
			->setCellValue('J1', 't_2025')
			->setCellValue('K1', 't_2026');
		$column = 2;
		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['opd_program_n'])
				// ->setCellValue('B' . $column, '')
				->setCellValue('B' . $column, $row['kegiatan']);

			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');
		// --------------------------------------------------------------
		// $spreadsheet->createSheet();

		// $spreadsheet->setActiveSheetIndex(1)
		// 	->setCellValue('A1', 'Sasaran Kegiatan');
		// $col = 2;
		// foreach ($data2 as $row) {
		// 	$spreadsheet->setActiveSheetIndex(1)
		// 		->setCellValue('A' . $col, $row['opd_kegiatan_sasaran']);

		// 	$col++;
		// }
		// $spreadsheet->getActiveSheet()->setTitle('Sasaran Kegiatan');

		$writer = new Xlsx($spreadsheet);
		$filename =  'Kegiatan - ' . date('Y-m-d-His');
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

		$data = $spreadsheet->getActiveSheet()->toArray();
		foreach ($data as $x => $row) {
			if ($x == 0) {
				continue;
			}
			$simpandata = [
				'opd_program_n' => $row[0],
				'opd_kegiatan_n' => $row[1],
				'opd_kegiatan_sasaran_n' => $row[2],
				'opd_indikator_kegiatan' => $row[3],
				'satuan' => $row[4],
				't_2021' => $row[5],
				't_2022' => $row[6],
				't_2023' => $row[7],
				't_2024' => $row[8],
				't_2025' => $row[9],
				't_2026' => $row[10],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			];

			$this->opd_kegiatan->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_kegiatan');
	}
	// ----------------------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_kegiatan->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->findAll();
		$data2 = $this->opd_kegiatan->getKegiatanSasaran();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Program')
			->setCellValue('C1', 'Kegiatan')
			->setCellValue('D1', 'Sasaran Kegiatan')
			->setCellValue('E1', 'Indikator Kegiatan')
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
				->setCellValue('A' . $column, $sisdata['id_opd_kegiatan'])
				->setCellValue('B' . $column, $sisdata['opd_program_n'])
				->setCellValue('C' . $column, $sisdata['opd_kegiatan_n'])
				->setCellValue('D' . $column, $sisdata['opd_kegiatan_sasaran_n'])
				->setCellValue('E' . $column, $sisdata['opd_indikator_kegiatan'])
				->setCellValue('F' . $column, $sisdata['satuan'])
				->setCellValue('G' . $column, $sisdata['t_2021'])
				->setCellValue('H' . $column, $sisdata['t_2022'])
				->setCellValue('I' . $column, $sisdata['t_2023'])
				->setCellValue('J' . $column, $sisdata['t_2024'])
				->setCellValue('K' . $column, $sisdata['t_2025'])
				->setCellValue('L' . $column, $sisdata['t_2026']);


			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');
		// --------------------------------------------------------------
		// $spreadsheet->createSheet();

		// $spreadsheet->setActiveSheetIndex(1)
		// 	->setCellValue('A1', 'Sasaran Kegiatan');
		// $col = 2;
		// foreach ($data2 as $row) {
		// 	$spreadsheet->setActiveSheetIndex(1)
		// 		->setCellValue('A' . $col, $row['opd_kegiatan_sasaran']);

		// 	$col++;
		// }
		// $spreadsheet->getActiveSheet()->setTitle('Sasaran Kegiatan');

		$writer = new Xlsx($spreadsheet);
		$filename =  'Kegiatan-Edit-' . date('Y-m-d-His');
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
				'opd_program_n' => $row[1],
				'opd_kegiatan_n' => $row[2],
				'opd_kegiatan_sasaran_n' => $row[3],
				'opd_indikator_kegiatan' => $row[4],
				'satuan' => $row[5],
				't_2021' => $row[6],
				't_2022' => $row[7],
				't_2023' => $row[8],
				't_2024' => $row[9],
				't_2025' => $row[10],
				't_2026' => $row[11],
				'updated_by' => user()->full_name,
			];

			$id = [
				'id_opd_kegiatan' => $row[0],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
			];
			$this->opd_kegiatan->set($simpandata)->where($id)->update();

			// $this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_kegiatan/');
	}
	// =================================Perubahan===========================
	public function export_perubahan()
	{
		$sisw = $this->opd_kegiatan->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id])->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Program')
			->setCellValue('B1', 'Kegiatan')
			->setCellValue('C1', 'Sasaran Kegiatan')
			->setCellValue('D1', 'Indikator Kegiatan')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 't_2021')
			->setCellValue('G1', 't_2022')
			->setCellValue('H1', 't_2023')
			->setCellValue('I1', 't_2024')
			->setCellValue('J1', 't_2025')
			->setCellValue('K1', 't_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['opd_program_n'])
				->setCellValue('B' . $column, $sisdata['opd_kegiatan_n'])
				->setCellValue('C' . $column, $sisdata['opd_kegiatan_sasaran_n'])
				->setCellValue('D' . $column, $sisdata['opd_indikator_kegiatan'])
				->setCellValue('E' . $column, $sisdata['satuan'])
				->setCellValue('F' . $column, $sisdata['t_2021'])
				->setCellValue('G' . $column, $sisdata['t_2022'])
				->setCellValue('H' . $column, $sisdata['t_2023'])
				->setCellValue('I' . $column, $sisdata['t_2024'])
				->setCellValue('J' . $column, $sisdata['t_2025'])
				->setCellValue('K' . $column, $sisdata['t_2026']);

			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');

		$writer = new Xlsx($spreadsheet);
		$filename =  'Kegiatan Murni-' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
