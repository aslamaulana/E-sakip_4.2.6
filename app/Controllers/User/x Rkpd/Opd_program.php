<?php

namespace App\Controllers\User\Rkpd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Rkpd\Model_opd_program;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_program extends BaseController
{
	protected $opd_program, $satuan, $tahun;

	public function __construct()
	{
		$this->rkpd_program = new Model_opd_program();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_program',
				'title' => 'User | PD program',
				'lok' => '<b>RENJA Program</b>',
				'rkpd_program' => $this->rkpd_program->Program(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_program', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_program_indik_edit($id)
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_program',
				'title' => 'User | RENJA program',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Program</a> -> <b>Ubah RENJA Program</b>',
				'validation' => \Config\Services::validation(),
				'indik' => $this->rkpd_program->find($id),
				'satuan' => $this->satuan->satuan(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_program_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_indik_update()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			if (!$this->validate([
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->rkpd_program->save([
				'id_rkpd_program' => $this->request->getVar('id'),
				'satuan' => $this->request->getVar('satuan'),
				't_tahun' => $this->request->getVar('t_tahun'),
				// 'rp_tahun' => $this->request->getVar('rp_tahun'),
				't_tahun+n' => $this->request->getVar('t_tahun+n'),
				// 'rp_tahun+n' => $this->request->getVar('rp_tahun+n'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/rkpd/opd_program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_indik_hapus($id)
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			try {
				$this->rkpd_program->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/rkpd/opd_program/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function import()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_program',
				'title' => 'User | RENJA program',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Program</a> -> <b>Import Data</b>',
			];
			echo view('user/Rkpd/opd_program_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->rkpd_program->getRenstraProgram();

		$spreadsheet = new Spreadsheet();

		$tahun = $_SESSION['tahun'];

		$spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Renstra Program')
			->setCellValue('B1', 'Indikator Program')
			->setCellValue('C1', 'Satuan')
			->setCellValue('D1', 'Target ' . $tahun)
			// ->setCellValue('E1', 'Pagu ' . $tahun)
			->setCellValue('E1', 'Target ' . $tahun + 1);
		// ->setCellValue('G1', 'Pagu ' . $tahun + 1);

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['opd_program_n'])
				->setCellValue('B' . $column, $row['opd_indikator_program'])
				->setCellValue('C' . $column, $row['satuan'])
				->setCellValue('D' . $column, $row['t_' . $tahun])
				// ->setCellValue('E' . $column, '')
				->setCellValue('E' . $column, $row['t_' . $tahun + 1]);
			// ->setCellValue('G' . $column, '');

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Renstra Program - RENJA Program (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
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
				'rkpd_program_n' => $row[0],
				'rkpd_indikator_program' => $row[1],
				'satuan' => $row[2],

				't_tahun' => $row[3],
				// 'rp_tahun' => $row[4],
				't_tahun+n' => $row[4],
				// 'rp_tahun+n' => $row[6],

				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			];

			$this->rkpd_program->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/rkpd/opd_program');
	}
	// ---------------------------------------------------------------
	public function export_edit()
	{
		$data = $this->rkpd_program->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$tahun = $_SESSION['tahun'];

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'RENJA Program')
			->setCellValue('C1', 'Indikator Program')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 'Target ' . $tahun)
			// ->setCellValue('F1', 'Pagu ' . $tahun)
			->setCellValue('F1', 'Target ' . $tahun + 1);
		// ->setCellValue('H1', 'Pagu ' . $tahun + 1);

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['id_rkpd_program'])
				->setCellValue('B' . $column, $row['rkpd_program_n'])
				->setCellValue('C' . $column, $row['rkpd_indikator_program'])
				->setCellValue('D' . $column, $row['satuan'])
				->setCellValue('E' . $column, $row['t_tahun'])
				// ->setCellValue('F' . $column, $row['rp_tahun'])
				->setCellValue('F' . $column, $row['t_tahun+n']);
			// ->setCellValue('H' . $column, $row['rp_tahun+n']);
			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'RENJA Program Edit - (' . $tahun . ') - ' . date('Y-m-d-His');
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
				'rkpd_program_n' => $row[1],
				'rkpd_indikator_program' => $row[2],
				'satuan' => $row[3],
				't_tahun' => $row[4],
				// 'rp_tahun' => $row[5],
				't_tahun+n' => $row[5],
				// 'rp_tahun+n' => $row[7],

				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			];
			$id = [
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'id_rkpd_program' => $row[0],
				'opd_id' => user()->opd_id,
			];
			$this->rkpd_program->set($simpandata)->where($id)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/rkpd/opd_program');
	}

	// ==================================Perubahan=============================
	public function export_perubahan()
	{
		$data = $this->rkpd_program->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$tahun = $_SESSION['tahun'];

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'RENJA Program')
			->setCellValue('B1', 'Indikator Program')
			->setCellValue('C1', 'Satuan')
			->setCellValue('D1', 'Target ' . $tahun)
			->setCellValue('E1', 'Target ' . $tahun + 1);

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['rkpd_program_n'])
				->setCellValue('B' . $column, $row['rkpd_indikator_program'])
				->setCellValue('C' . $column, $row['satuan'])
				->setCellValue('D' . $column, $row['t_tahun'])
				->setCellValue('E' . $column, $row['t_tahun+n']);
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'RENJA Program Murni - (' . $tahun . ') - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
