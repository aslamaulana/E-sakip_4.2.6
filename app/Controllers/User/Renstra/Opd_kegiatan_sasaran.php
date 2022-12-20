<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_kegiatan_sasaran;
use App\Models\User\Renstra\Model_opd_program_sasaran;
use App\Models\User\Renstra\Model_opd_sasaran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_kegiatan_sasaran extends BaseController
{
	protected $opd_kegiatan_sasaran, $opd_program_sasaran, $sasaran;

	public function __construct()
	{
		$this->opd_program_sasaran = new Model_opd_program_sasaran();
		$this->opd_kegiatan_sasaran = new Model_opd_kegiatan_sasaran();
		$this->opd_sasaran = new Model_opd_sasaran();
		// $this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sasaran',
				'title' => 'User | PD Kegiatan',
				'lok' => '<b>PD Sasaran kegiatan</b>',
				'program_sasaran' => $this->opd_program_sasaran->where(['opd_id' => user()->opd_id])->findAll(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_kegiatan_sasaran', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sasaran_add($sasaran_program)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sasaran',
				'title' => 'User | PD Kegiatan',
				'lok' => '<a href="/user/renstra/opd_kegiatan_sasaran">PD Sasaran Kegiatan</a> -> <b>Tambah PD Sasaran Kegiatan</b>',
				'sasaran_program' => $sasaran_program,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_kegiatan_sasaran_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sasaran_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'kegiatan_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan_sasaran->save([
				'opd_program_sasaran_n' => $this->request->getVar('sasaran_program'),
				'opd_kegiatan_sasaran' => $this->request->getVar('kegiatan_sasaran'),
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sasaran');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sasaran_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sasaran',
				'title' => 'User | PD Kegiatan',
				'lok' => '<a href="/user/renstra/opd_kegiatan_sasaran">PD Sasaran Kegiatan</a> -> <b>Ubah PD Sasaran Kegiatan</b>',
				'kegiatan_sasaran' => $this->opd_kegiatan_sasaran->find($id),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_kegiatan_sasaran_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sasaran_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'kegiatan_sasaran' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan_sasaran->save([
				'id_opd_kegiatan_sasaran' => $this->request->getVar('id'),
				'opd_kegiatan_sasaran' => $this->request->getVar('kegiatan_sasaran'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sasaran');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sasaran_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_kegiatan_sasaran->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sasaran');
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
				'mn' => 'opd_kegiatan_sasaran',
				'title' => 'User | PD Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">PD Sasaran Kegiatan</a> -> <b>Import PD Sasaran Kegiatan</b>',
			];
			echo view('user/Renstra/opd_kegiatan_sasaran_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->opd_program_sasaran->where(['opd_id' => user()->opd_id])->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Sasaran Program')
			->setCellValue('B1', 'Sasaran Kegiatan');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['opd_program_sasaran']);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sasaran Kegiatan - ' . date('Y-m-d-His');
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
				'opd_program_sasaran_n' => $row[0],
				'opd_kegiatan_sasaran' => $row[1],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			];

			$this->opd_kegiatan_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sasaran');
	}
	// ----------------------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_kegiatan_sasaran->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:C1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Sasaran Program')
			->setCellValue('C1', 'Sasaran Kegiatan');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_kegiatan_sasaran'])
				->setCellValue('B' . $column, $sisdata['opd_program_sasaran_n'])
				->setCellValue('C' . $column, $sisdata['opd_kegiatan_sasaran']);

			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sasaran Kegiatan-Edit-' . date('Y-m-d-His');
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
