<?php

namespace App\Controllers\User\Rkpd;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Rkpd\Model_opd_kegiatan_sub;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_kegiatan_sub extends BaseController
{
	protected $opd_kegiatan_sub, $satuan, $tahun;

	public function __construct()
	{
		$this->rkpd_kegiatan_sub = new Model_opd_kegiatan_sub();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_kegiatan_sub',
				'title' => 'User | PD Sub Kegiatan',
				'lok' => '<b>RENJA Sub Kegiatan</b>',
				'rkpd_kegiatan_sub' => $this->rkpd_kegiatan_sub->kegiatan_sub(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_kegiatan_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_indik_edit($id)
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			$data = [
				'gr' => 'rkpd',
				'mn' => 'rkpd_kegiatan_sub',
				'title' => 'User | RENJA Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Sub Kegiatan</a> -> <b>Ubah RENJA Sub Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'indik' => $this->rkpd_kegiatan_sub->find($id),
				'satuan' => $this->satuan->satuan(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Rkpd/opd_kegiatan_sub_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_indik_update()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			if (!$this->validate([
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->rkpd_kegiatan_sub->save([
				'id_rkpd_kegiatan_sub' => $this->request->getVar('id'),
				'satuan' => $this->request->getVar('satuan'),
				't_tahun' => $this->request->getVar('t_tahun'),
				'rp_tahun' => $this->request->getVar('rp_tahun'),
				't_tahun+n' => $this->request->getVar('t_tahun+n'),
				'rp_tahun+n' => $this->request->getVar('rp_tahun+n'),
				'lokasi' => $this->request->getVar('lokasi'),
				'sumber_dana' => $this->request->getVar('sumber_dana'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_indik_hapus($id)
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			try {
				$this->rkpd_kegiatan_sub->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function hapusAll()
	{
		if (has_permission('User') && menu('renja')->kunci == 'tidak') :
			try {
				$this->rkpd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->delete();
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub/');
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub/');
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
				'mn' => 'rkpd_kegiatan_sub',
				'title' => 'User | RENJA Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">RENJA Sub Kegiatan</a> -> <b>Import RENJA Sub Kegiatan</b>',
			];
			echo view('user/Rkpd/opd_kegiatan_sub_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->rkpd_kegiatan_sub->getRenstraKegiatan_sub();

		$spreadsheet = new Spreadsheet();

		$tahun = $_SESSION['tahun'];

		$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Renstra Kegiatan')
			->setCellValue('B1', 'Renstra Sub Kegiatan')
			->setCellValue('C1', 'Indikator Sub Kegiatan')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 'Target ' . $tahun)
			->setCellValue('F1', 'Pagu ' . $tahun)
			->setCellValue('G1', 'Target ' . $tahun + 1)
			->setCellValue('H1', 'Pagu ' . $tahun + 1)
			->setCellValue('I1', 'Lokasi')
			->setCellValue('J1', 'Sumber Dana');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['opd_kegiatan_n'])
				->setCellValue('B' . $column, $row['opd_kegiatan_sub_n'])
				->setCellValue('C' . $column, $row['opd_indikator_kegiatan_sub'])
				->setCellValue('D' . $column, $row['satuan'])
				->setCellValue('E' . $column, $row['t_' . $tahun])
				->setCellValue('F' . $column, $row['rp_' . $tahun])
				->setCellValue('G' . $column, $row['t_' . $tahun + 1])
				->setCellValue('H' . $column, $row['rp_' . $tahun + 1]);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Renstra Sub Kegiatan - RENJA Sub Kegiatan (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
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
				'rkpd_kegiatan_n' => $row[0],
				'rkpd_kegiatan_sub_n' => $row[1],
				'rkpd_indikator_kegiatan_sub' => $row[2],
				'satuan' => $row[3],

				't_tahun' => $row[4],
				'rp_tahun' => $row[5],
				't_tahun+n' => $row[6],
				'rp_tahun+n' => $row[7],
				'lokasi' => $row[8],
				'sumber_dana' => $row[9],

				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			];

			$this->rkpd_kegiatan_sub->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub');
	}
	// ---------------------------------------------------------------
	public function export_edit()
	{
		$data = $this->rkpd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$tahun = $_SESSION['tahun'];

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'RKPD Kegiatan')
			->setCellValue('C1', 'RENJA Sub Kegiatan')
			->setCellValue('D1', 'Indikator Sub Kegiatan')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 'Target ' . $tahun)
			->setCellValue('G1', 'Pagu ' . $tahun)
			->setCellValue('H1', 'Target ' . $tahun + 1)
			->setCellValue('I1', 'Pagu ' . $tahun + 1)
			->setCellValue('J1', 'Lokasi')
			->setCellValue('K1', 'Sumber Dana');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['id_rkpd_kegiatan_sub'])
				->setCellValue('B' . $column, $row['rkpd_kegiatan_n'])
				->setCellValue('C' . $column, $row['rkpd_kegiatan_sub_n'])
				->setCellValue('D' . $column, $row['rkpd_indikator_kegiatan_sub'])
				->setCellValue('E' . $column, $row['satuan'])
				->setCellValue('F' . $column, $row['t_tahun'])
				->setCellValue('G' . $column, $row['rp_tahun'])
				->setCellValue('H' . $column, $row['t_tahun+n'])
				->setCellValue('I' . $column, $row['rp_tahun+n'])
				->setCellValue('J' . $column, $row['lokasi'])
				->setCellValue('K' . $column, $row['sumber_dana']);
			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'RKPD Sub Kegitan Edit - (' . $tahun . ') - ' . date('Y-m-d-His');
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
				'rkpd_kegiatan_n' => $row[1],
				'rkpd_kegiatan_sub_n' => $row[2],
				'rkpd_indikator_kegiatan_sub' => $row[3],
				'satuan' => $row[4],
				't_tahun' => $row[5],
				'rp_tahun' => $row[6],
				't_tahun+n' => $row[7],
				'rp_tahun+n' => $row[8],
				'lokasi' => $row[9],
				'sumber_dana' => $row[10],

				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			];
			$id = [
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'id_rkpd_kegiatan_sub' => $row[0],
				'opd_id' => user()->opd_id,
			];
			$this->rkpd_kegiatan_sub->set($simpandata)->where($id)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/rkpd/opd_kegiatan_sub');
	}
	// ====================================Perubahan===========================
	public function export_perubahan()
	{
		$data = $this->rkpd_kegiatan_sub->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
		$tahun = $_SESSION['tahun'];

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'RKPD Kegiatan')
			->setCellValue('B1', 'RENJA Sub Kegiatan')
			->setCellValue('C1', 'Indikator Sub Kegiatan')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 'Target ' . $tahun)
			->setCellValue('F1', 'Pagu ' . $tahun)
			->setCellValue('G1', 'Target ' . $tahun + 1)
			->setCellValue('H1', 'Pagu ' . $tahun + 1)
			->setCellValue('I1', 'Lokasi')
			->setCellValue('J1', 'Sumber Dana');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['rkpd_kegiatan_n'])
				->setCellValue('B' . $column, $row['rkpd_kegiatan_sub_n'])
				->setCellValue('C' . $column, $row['rkpd_indikator_kegiatan_sub'])
				->setCellValue('D' . $column, $row['satuan'])
				->setCellValue('E' . $column, $row['t_tahun'])
				->setCellValue('F' . $column, $row['rp_tahun'])
				->setCellValue('G' . $column, $row['t_tahun+n'])
				->setCellValue('H' . $column, $row['rp_tahun+n'])
				->setCellValue('I' . $column, $row['lokasi'])
				->setCellValue('J' . $column, $row['sumber_dana']);
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'RKPD Sub Kegitan Murni - (' . $tahun . ') - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
