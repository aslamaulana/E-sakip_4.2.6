<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Renstra\Model_opd_kegiatan_sub;
use App\Models\User\Renstra\Model_opd_kegiatan;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_kegiatan_sub extends BaseController
{
	protected $opd_kegiatan_sub, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_kegiatan_sub = new Model_opd_kegiatan_sub();
		$this->opd_kegiatan = new Model_opd_kegiatan();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sub',
				'title' => 'User | Sub kegiatan',
				'lok' => '<b>Sub Kegiatan</b>',
				'opd_kegiatan_sub' => $this->opd_kegiatan_sub->kegiatan_sub(),
				'tahunA' => $this->tahun->tahunA(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_kegiatan_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ambilopdsubkegiatan()
	{
		$kegiatan = $this->request->getVar('id');
		$data = $this->opd_kegiatan_sub->getKegiatanSub($kegiatan);

		echo json_encode($data);
	}
	public function opd_kegiatan_sub_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<a href=".">Sub Kegiatan</a> -> <b>Tambah Sub Kegiatan</b>',
				'opd_kegiatan' => $this->opd_kegiatan_sub->getOpdKegiatan(),
				// 'opd_kegiatan_sub' => $this->opd_kegiatan_sub->getProgram(),
				'satuan' => $this->satuan->satuan(),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_kegiatan_sub_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'opd_kegiatan_sub' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'opd_kegiatan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'indikator_kegiatan_sub' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan_sub->save([
				'opd_kegiatan_n' => $this->request->getVar('opd_kegiatan'),
				'opd_kegiatan_sub_n' => $this->request->getVar('opd_kegiatan_sub'),
				'opd_indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
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
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_edit()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<a href=".">Sub Kegiatan</a> -> <b>Ubah Sub Kegiatan</b>',
				'opd_kegiatan' => $this->opd_kegiatan_sub->getOpdKegiatan(),
				// 'opd_kegiatan' => $this->opd_kegiatan->getkegiatan(),
				'kegiatan_sub' => $_GET['p'],
				'kegiatan' => $_GET['a'],
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Renstra/opd_kegiatan_sub_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'opd_kegiatan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'opd_kegiatan_sub' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$data = [
				'opd_kegiatan_sub_n' => $this->request->getVar('opd_kegiatan_sub'),
				'opd_kegiatan_n' => $this->request->getVar('opd_kegiatan'),
				'updated_by' => user()->full_name,
			];
			$dataw = [
				'opd_kegiatan_sub_n' => $this->request->getVar('kegiatan_sub_old'),
				'opd_kegiatan_n' => $this->request->getVar('kegiatan_old'),
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
			];
			$this->opd_kegiatan_sub->set($data)->where($dataw)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------

	public function opd_kegiatan_sub_indik_add()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">Sub Kegiatan</a> -> <b>Tambah Indikator Sub Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'satuan' => $this->satuan->satuan(),
				'kegiatan_sub' => $_GET['p'],
				'kegiatan' => $_GET['a'],
			];
			echo view('user/Renstra/opd_kegiatan_sub_indik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_indik_create()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_kegiatan_sub' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan_sub->save([
				'opd_kegiatan_n' => $this->request->getVar('kegiatan'),
				'opd_kegiatan_sub_n' => $this->request->getVar('kegiatan_sub'),
				'opd_indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
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
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_indik_edit($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">Sub Kegiatan</a> -> <b>Tambah Indikator Sub Kegiatan</b>',
				'validation' => \Config\Services::validation(),
				'indik' => $this->opd_kegiatan_sub->find($id),
				'satuan' => $this->satuan->satuan(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_kegiatan_sub_indik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_indik_update()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			if (!$this->validate([
				'indikator_kegiatan_sub' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->opd_kegiatan_sub->save([
				'id_opd_kegiatan_sub' => $this->request->getVar('id'),
				'opd_indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
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
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function opd_kegiatan_sub_indik_hapus($id)
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_kegiatan_sub->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------------------------------
	public function hapusAll()
	{
		if (has_permission('User') && menu('renstra')->kunci == 'tidak') :
			try {
				$this->opd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->delete();
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
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
				'mn' => 'opd_kegiatan_sub',
				'title' => 'User | Sub Kegiatan',
				'lok' => '<a onclick="history.back(-1)" href="#">Sub Kegiatan</a> -> <b>Import Sub Kegiatan</b>',
			];
			echo view('user/Renstra/opd_kegiatan_sub_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->opd_kegiatan_sub->getKegiatanExport();

		$spreadsheet = new Spreadsheet();
		// --------------------------------------------------------------
		$spreadsheet->getActiveSheet()->getStyle('A1:P1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Kegiatan')
			->setCellValue('B1', 'Sub Kegiatan')
			->setCellValue('C1', 'Indikator Sub Kegiatan')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 't_2021')
			->setCellValue('F1', 'rp_2021')
			->setCellValue('G1', 't_2022')
			->setCellValue('H1', 'rp_2022')
			->setCellValue('I1', 't_2023')
			->setCellValue('J1', 'rp_2023')
			->setCellValue('K1', 't_2024')
			->setCellValue('L1', 'rp_2024')
			->setCellValue('M1', 't_2025')
			->setCellValue('N1', 'rp_2025')
			->setCellValue('O1', 't_2026')
			->setCellValue('P1', 'rp_2026');
		$column = 2;
		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['opd_kegiatan_n'])
				->setCellValue('B' . $column, $row['sub_kegiatan']);

			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sub Kegiatan - ' . date('Y-m-d-His');
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
				'opd_kegiatan_n' => $row[0],
				'opd_kegiatan_sub_n' => $row[1],
				'opd_indikator_kegiatan_sub' => $row[2],
				'satuan' => $row[3],
				't_2021' => $row[4],
				'rp_2021' => $row[5],
				't_2022' => $row[6],
				'rp_2022' => $row[7],
				't_2023' => $row[8],
				'rp_2023' => $row[9],
				't_2024' => $row[10],
				'rp_2024' => $row[11],
				't_2025' => $row[12],
				'rp_2025' => $row[13],
				't_2026' => $row[14],
				'rp_2026' => $row[15],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			];

			$this->opd_kegiatan_sub->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
	}
	// ----------------------------------------------------------------------
	public function export_edit()
	{
		$sisw = $this->opd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:Q1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Kegiatan')
			->setCellValue('C1', 'Sub Kegiatan')
			->setCellValue('D1', 'Indikator Sub Kegiatan')
			->setCellValue('E1', 'Satuan')
			->setCellValue('F1', 't_2021')
			->setCellValue('G1', 'rp_2021')
			->setCellValue('H1', 't_2022')
			->setCellValue('I1', 'rp_2022')
			->setCellValue('J1', 't_2023')
			->setCellValue('K1', 'rp_2023')
			->setCellValue('L1', 't_2024')
			->setCellValue('M1', 'rp_2024')
			->setCellValue('N1', 't_2025')
			->setCellValue('O1', 'rp_2025')
			->setCellValue('P1', 't_2026')
			->setCellValue('Q1', 'rp_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['id_opd_kegiatan_sub'])
				->setCellValue('B' . $column, $sisdata['opd_kegiatan_n'])
				->setCellValue('C' . $column, $sisdata['opd_kegiatan_sub_n'])
				->setCellValue('D' . $column, $sisdata['opd_indikator_kegiatan_sub'])
				->setCellValue('E' . $column, $sisdata['satuan'])
				->setCellValue('F' . $column, $sisdata['t_2021'])
				->setCellValue('G' . $column, $sisdata['rp_2021'])
				->setCellValue('H' . $column, $sisdata['t_2022'])
				->setCellValue('I' . $column, $sisdata['rp_2022'])
				->setCellValue('J' . $column, $sisdata['t_2023'])
				->setCellValue('K' . $column, $sisdata['rp_2023'])
				->setCellValue('L' . $column, $sisdata['t_2024'])
				->setCellValue('M' . $column, $sisdata['rp_2024'])
				->setCellValue('N' . $column, $sisdata['t_2025'])
				->setCellValue('O' . $column, $sisdata['rp_2025'])
				->setCellValue('P' . $column, $sisdata['t_2026'])
				->setCellValue('Q' . $column, $sisdata['rp_2026']);


			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sub Kegiatan-Edit-' . date('Y-m-d-His');
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
				'opd_kegiatan_n' => $row[1],
				'opd_kegiatan_sub_n' => $row[2],
				'opd_indikator_kegiatan_sub' => $row[3],
				'satuan' => $row[4],
				't_2021' => $row[5],
				'rp_2021' => $row[6],
				't_2022' => $row[7],
				'rp_2022' => $row[8],
				't_2023' => $row[9],
				'rp_2023' => $row[10],
				't_2024' => $row[11],
				'rp_2024' => $row[12],
				't_2025' => $row[13],
				'rp_2025' => $row[14],
				't_2026' => $row[15],
				'rp_2026' => $row[16],
				'updated_by' => user()->full_name,
			];

			$id = [
				'id_opd_kegiatan_sub' => $row[0],
				'opd_id' => user()->opd_id,
				'perubahan' => $_SESSION['perubahan'],
			];
			$this->opd_kegiatan_sub->set($simpandata)->where($id)->update();

			// $this->opd_sasaran->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/renstra/opd_kegiatan_sub/');
	}
	// =================================Perubahan================================
	public function export_perubahan()
	{
		$sisw = $this->opd_kegiatan_sub->where(['perubahan' => 'Murni', 'opd_id' => user()->opd_id])->findAll();

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getActiveSheet()->getStyle('A1:P1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Kegiatan')
			->setCellValue('B1', 'Sub Kegiatan')
			->setCellValue('C1', 'Indikator Sub Kegiatan')
			->setCellValue('D1', 'Satuan')
			->setCellValue('E1', 't_2021')
			->setCellValue('F1', 'rp_2021')
			->setCellValue('G1', 't_2022')
			->setCellValue('H1', 'rp_2022')
			->setCellValue('I1', 't_2023')
			->setCellValue('J1', 'rp_2023')
			->setCellValue('K1', 't_2024')
			->setCellValue('L1', 'rp_2024')
			->setCellValue('M1', 't_2025')
			->setCellValue('N1', 'rp_2025')
			->setCellValue('O1', 't_2026')
			->setCellValue('P1', 'rp_2026');

		$column = 2;

		foreach ($sisw as $sisdata) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $sisdata['opd_kegiatan_n'])
				->setCellValue('B' . $column, $sisdata['opd_kegiatan_sub_n'])
				->setCellValue('C' . $column, $sisdata['opd_indikator_kegiatan_sub'])
				->setCellValue('D' . $column, $sisdata['satuan'])
				->setCellValue('E' . $column, $sisdata['t_2021'])
				->setCellValue('F' . $column, $sisdata['rp_2021'])
				->setCellValue('G' . $column, $sisdata['t_2022'])
				->setCellValue('H' . $column, $sisdata['rp_2022'])
				->setCellValue('I' . $column, $sisdata['t_2023'])
				->setCellValue('J' . $column, $sisdata['rp_2023'])
				->setCellValue('K' . $column, $sisdata['t_2024'])
				->setCellValue('L' . $column, $sisdata['rp_2024'])
				->setCellValue('M' . $column, $sisdata['t_2025'])
				->setCellValue('N' . $column, $sisdata['rp_2025'])
				->setCellValue('O' . $column, $sisdata['t_2026'])
				->setCellValue('P' . $column, $sisdata['rp_2026']);

			$column++;
		}
		$spreadsheet->getActiveSheet()->setTitle('Maping');

		$writer = new Xlsx($spreadsheet);
		$filename =  'Sub Kegiatan Murni-' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
