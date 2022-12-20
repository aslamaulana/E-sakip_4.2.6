<?php

namespace App\Controllers\User\Rkpd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Rkpd\Model_opd_kegiatan;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_kegiatan extends BaseController
{
	protected $opd_kegiatan, $satuan, $tahun;

	public function __construct()
	{
		$this->rkpd_kegiatan = new Model_opd_kegiatan();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_kegiatan',
				'title' => 'User | PD Kegiatan',
				'lok' => '<b>RENJA Kegiatan</b>',
				'rkpd_kegiatan' => $this->rkpd_kegiatan->kegiatan(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_kegiatan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function opd_kegiatan_indik_edit($id)
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_kegiatan',
				'title' => 'User | RENJA Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Kegiatan</a> -> <b>Ubah RENJA Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'indik' => $this->rkpd_kegiatan->find($id),
				'satuan' => $this->satuan->satuan(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_kegiatan_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_indik_update()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			if (!$this->validate([
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->rkpd_kegiatan->save([
				'id_rkpd_kegiatan' => $this->request->getVar('id'),
				'satuan' => $this->request->getVar('satuan'),
				't_tahun' => $this->request->getVar('t_tahun'),
				't_tahun+n' => $this->request->getVar('t_tahun+n'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_indik_hapus($id)
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			try {
				$this->rkpd_kegiatan->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function hapusAll()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			try {
				$this->rkpd_kegiatan->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->delete();
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan/');
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan/');
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
				'mn' => 'rkpd_kegiatan',
				'title' => 'User | RENJA Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Kegiatan</a> -> <b>Import RENJA Kegiatan</b>',
			];
			echo view('user/Rkpd/opd_kegiatan_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->rkpd_kegiatan->getRenstraKegiatan();

		$spreadsheet = new Spreadsheet();

		$tahun = $_SESSION['tahun'];

		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Renstra Program')
			->setCellValue('B1', 'Renstra Kegiatan')
			->setCellValue('C1', 'Indikator Kegiatan')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 'Target ' . $tahun)
			// ->setCellValue('F1', 'Pagu ' . $tahun)
			->setCellValue('F1', 'Target ' . $tahun + 1);
		// ->setCellValue('H1', 'Pagu ' . $tahun + 1);

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['opd_program_n'])
				->setCellValue('B' . $column, $row['opd_kegiatan_n'])
				->setCellValue('C' . $column, $row['opd_indikator_kegiatan'])
				->setCellValue('D' . $column, $row['satuan'])
				->setCellValue('E' . $column, $row['t_' . $tahun])
				->setCellValue('F' . $column, $row['t_' . $tahun + 1]);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Renstra Kegiatan - RENJA Kegiatan (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
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
				'rkpd_kegiatan_n' => $row[1],
				'rkpd_indikator_kegiatan' => $row[2],
				'satuan' => $row[3],

				't_tahun' => $row[4],
				't_tahun+n' => $row[5],

				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			];

			$this->rkpd_kegiatan->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan');
	}
	// ---------------------------------------------------------------
	public function export_edit()
	{
		$data = $this->rkpd_kegiatan->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$tahun = $_SESSION['tahun'];

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'RENJA Program')
			->setCellValue('C1', 'RENJA Kegiatan')
			->setCellValue('D1', 'Indikator Kegiatan')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 'Target ' . $tahun)
			->setCellValue('G1', 'Target ' . $tahun + 1);

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['id_rkpd_kegiatan'])
				->setCellValue('B' . $column, $row['rkpd_program_n'])
				->setCellValue('C' . $column, $row['rkpd_kegiatan_n'])
				->setCellValue('D' . $column, $row['rkpd_indikator_kegiatan'])
				->setCellValue('E' . $column, $row['satuan'])
				->setCellValue('F' . $column, $row['t_tahun'])
				->setCellValue('G' . $column, $row['t_tahun+n']);
			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'RENJA Kegiatan Edit - (' . $tahun . ') - ' . date('Y-m-d-His');
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
				'rkpd_kegiatan_n' => $row[2],
				'rkpd_indikator_kegiatan' => $row[3],
				'satuan' => $row[4],
				't_tahun' => $row[5],
				// 'rp_tahun' => $row[6],
				't_tahun+n' => $row[6],
				// 'rp_tahun+n' => $row[8],

				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			];
			$id = [
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'id_rkpd_kegiatan' => $row[0],
				'opd_id' => user()->opd_id,
			];
			$this->rkpd_kegiatan->set($simpandata)->where($id)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan');
	}
	// ============================Perubahan==============================
	public function export_perubahan()
	{
		$data = $this->rkpd_kegiatan->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$tahun = $_SESSION['tahun'];

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'RENJA Program')
			->setCellValue('B1', 'RENJA Kegiatan')
			->setCellValue('C1', 'Indikator Kegiatan')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 'Target ' . $tahun)
			->setCellValue('F1', 'Target ' . $tahun + 1);

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['rkpd_program_n'])
				->setCellValue('B' . $column, $row['rkpd_kegiatan_n'])
				->setCellValue('C' . $column, $row['rkpd_indikator_kegiatan'])
				->setCellValue('D' . $column, $row['satuan'])
				->setCellValue('E' . $column, $row['t_tahun'])
				->setCellValue('F' . $column, $row['t_tahun+n']);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'RENJA Kegiatan Murni - (' . $tahun . ') - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
