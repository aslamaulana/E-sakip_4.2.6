<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_program_sasaran;
use App\Models\User\Renstra\Model_opd_sasaran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_program_sasaran extends BaseController
{
	protected $opd_program_sasaran, $sasaran;

	public function __construct()
	{
		$this->opd_program_sasaran = new Model_opd_program_sasaran();
		$this->opd_sasaran = new Model_opd_sasaran();
		// $this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program_sasaran',
				'title' => 'User | PD program',
				'lok' => '<b>PD Sasaran Program</b>',
				'sasaran' => $this->opd_sasaran->distinct('opd_sasaran')->select('opd_sasaran')->where(['opd_id' => user()->opd_id])->findAll(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_program_sasaran', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_sasaran_add($sasaran_opd)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program_sasaran',
				'title' => 'User | PD program',
				'lok' => '<a href="/user/renstra/opd_program_sasaran">PD Sasaran Program</a> -> <b>Tambah PD Sasaran Program</b>',
				'sasaran_opd' => $sasaran_opd,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_program_sasaran_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_sasaran_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'program_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_program_sasaran->save([
				'opd_sasaran_n' => $this->request->getVar('sasaran_opd'),
				'opd_program_sasaran' => $this->request->getVar('program_sasaran'),
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_program_sasaran');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_sasaran_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_program_sasaran',
				'title' => 'User | PD program',
				'lok' => '<a href="/user/renstra/opd_program_sasaran">PD Sasaran Program</a> -> <b>Ubah PD Sasaran Program</b>',
				'program_sasaran' => $this->opd_program_sasaran->find($id),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_program_sasaran_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_sasaran_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'program_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_program_sasaran->save([
				'id_opd_program_sasaran' => $this->request->getVar('id'),
				'opd_program_sasaran' => $this->request->getVar('program_sasaran'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_program_sasaran');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_program_sasaran_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_program_sasaran->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_program_sasaran');
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
				'mn' => 'opd_program_sasaran',
				'title' => 'User | PD program',
				'lok' => '<a onclick="history.back(-1)" href="#">PD Sasaran Program</a> -> <b>Import PD Sasaran Program</b>',
			];
			echo view('user/Renstra/opd_program_sasaran_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->opd_sasaran->distinct('opd_sasaran')->select('opd_sasaran')->where(['opd_id' => user()->opd_id])->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Opd Sasaran')
			->setCellValue('B1', 'Sasaran Program');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['opd_sasaran']);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sasaran Program - ' . date('Y-m-d-His');
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
				'opd_sasaran_n' => $row[0],
				'opd_program_sasaran' => $row[1],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			];

			$this->opd_program_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_program_sasaran');
	}
	// ----------------------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_program_sasaran->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:C1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Opd Sasaran')
			->setCellValue('C1', 'Sasaran Program');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_program_sasaran'])
				->setCellValue('B' . $column, $sisdata['opd_sasaran_n'])
				->setCellValue('C' . $column, $sisdata['opd_program_sasaran']);

			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sasaran Program-Edit-' . date('Y-m-d-His');
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
				'opd_sasaran_n' => $row[1],
				'opd_program_sasaran' => $row[2],
				'updated_by' => user()->full_name,
			];
			$id = [
				'id_opd_program_sasaran' => $row[0],
				'opd_id' => user()->opd_id,
			];
			$this->opd_program_sasaran->set($simpandata)->where($id)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_program_sasaran/');
	}
}
