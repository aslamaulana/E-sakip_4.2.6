<?php

namespace App\Controllers\User\Ropk;

use App\Controllers\BaseController;
use App\Models\Admin\RPJMD\Model_satuan;
use App\Models\User\Ropk\Model_opd_kegiatan_sub;
use App\Models\User\Ropk\Model_ropk_organisasi_kegiatan_sub;
use App\Models\User\Ropk\Model_ropk_keuangan_kegiatan_sub;
use App\Models\User\Ropk\Model_ropk_fisik;
use App\Models\User\Ropk\Model_ropk_organisasi;
use App\Models\Admin\RPJMD\Model_tahun;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ropk_fisik extends BaseController
{
	protected $opd_kegiatan_sub, $satuan, $tahun;

	public function __construct()
	{
		$this->ropk_organisasi_kegiatan_sub = new Model_ropk_organisasi_kegiatan_sub();
		$this->ropk_kegiatan_sub = new Model_ropk_keuangan_kegiatan_sub(); // Ropk fisik miroring sub kegiatan dari keuangan
		$this->ropk_fisik = new Model_ropk_fisik();
		$this->ropk_organisasi = new Model_ropk_organisasi();
		$this->satuan = new Model_satuan();
		$this->tahun = new Model_tahun();
	}
	public function fisik($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_fisik',
				'title' => 'User | Cantik Fisik',
				'lok' => 'Sub Kegiatan -> <b>Cantik Fisik</b>',
				'DT' => $this->ropk_kegiatan_sub->find($id),
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('user/Ropk/ropk_fisik', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function grafik()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_fisik',
				'title' => 'User | Cantik Fisik',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Fisik</a> -> <b>Grafik</b>',
				'rkpd_kegiatan' => $this->ropk_kegiatan_sub->where(['rkpd_kegiatan_n' => $_GET['k'], 'rkpd_kegiatan_sub_n' => $_GET['s']])->findAll(),
				'db' => \Config\Database::connect(),
			];
			// dd($data);
			echo view('user/Ropk/ropk_fisik_grafik', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function fisik_add($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_fisik',
				'title' => 'User | Cantik Fisik',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Fisik</a> -> <b>Tambah Tahap Aktivitas</b>',
				'satuan' => $this->satuan->satuan(),
				'DT' => $this->ropk_kegiatan_sub->find($id),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ropk/ropk_fisik_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function fisik_create()
	{
		if (has_permission('User')) :

			$this->ropk_fisik->save([
				'rkpd_kegiatan' => $this->request->getVar('kegiatan'),
				'rkpd_kegiatan_sub' => $this->request->getVar('kegiatan_sub'),
				'ropk_tahap' => $this->request->getVar('tahap'),
				'rkpd_indikator_kegiatan_sub' => $this->request->getVar('indikator_kegiatan_sub'),
				'ropk_tahap_aktivitas' => $this->request->getVar('aktifitas'),
				'ropk_sasaran' => $this->request->getVar('ropk_sasaran'),
				'ropk_sasaran_target' => $this->request->getVar('ropk_sasaran_target'),
				'ropk_sasaran_satuan' => $this->request->getVar('satuan'),
				'ropk_bobot_acuan' => $this->request->getVar('bobot_acuan'),
				'b1' => $this->request->getVar('b1'),
				'b2' => $this->request->getVar('b2'),
				'b3' => $this->request->getVar('b3'),
				'b4' => $this->request->getVar('b4'),
				'b5' => $this->request->getVar('b5'),
				'b6' => $this->request->getVar('b6'),
				'b7' => $this->request->getVar('b7'),
				'b8' => $this->request->getVar('b8'),
				'b9' => $this->request->getVar('b9'),
				'b10' => $this->request->getVar('b10'),
				'b11' => $this->request->getVar('b11'),
				'b12' => $this->request->getVar('b12'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ropk/ropk_fisik/fisik/' . $this->request->getVar('id'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function fisik_edit($id, $sub = '')
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_fisik',
				'title' => 'User | Cantik Fisik',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Fisik</a> -> <b>Tambah Tahap Aktivitas</b>',
				'satuan' => $this->satuan->satuan(),
				'DT' => $this->ropk_kegiatan_sub->find($sub),
				'fisik' => $this->ropk_fisik->find($id),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ropk/ropk_fisik_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function fisik_update()
	{
		if (has_permission('User')) :

			$this->ropk_fisik->save([
				'id_ropk_fisik' => $this->request->getVar('id'),
				'ropk_tahap_aktivitas' => $this->request->getVar('aktifitas'),
				'ropk_sasaran' => $this->request->getVar('ropk_sasaran'),
				'ropk_sasaran_target' => $this->request->getVar('ropk_sasaran_target'),
				'ropk_sasaran_satuan' => $this->request->getVar('satuan'),
				'ropk_bobot_acuan' => $this->request->getVar('bobot_acuan'),
				'tahun' => $_SESSION['tahun'],
				'b1' => $this->request->getVar('b1'),
				'b2' => $this->request->getVar('b2'),
				'b3' => $this->request->getVar('b3'),
				'b4' => $this->request->getVar('b4'),
				'b5' => $this->request->getVar('b5'),
				'b6' => $this->request->getVar('b6'),
				'b7' => $this->request->getVar('b7'),
				'b8' => $this->request->getVar('b8'),
				'b9' => $this->request->getVar('b9'),
				'b10' => $this->request->getVar('b10'),
				'b11' => $this->request->getVar('b11'),
				'b12' => $this->request->getVar('b12'),
				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ropk/ropk_fisik/fisik/' . $this->request->getVar('id_sub'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function fisik_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->ropk_fisik->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->back();
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	/* ------------------------------------Data RKPD Sub Kegiatan-----------------------------------
	---------------------------------------Data RKPD Sub Kegiatan-----------------------------------
	---------------------------------------Data RKPD Sub Kegiatan-----------------------------------
	---------------------------------------Data RKPD Sub Kegiatan-------------------------------- */
	// public function ropk_fisik_kegiatan_sub_edit($id)
	// {
	// 	if (has_permission('User')) :
	// 		$data = [
	// 			'gr' => 'ropk',
	// 			'mn' => 'ropk_fisik',
	// 			'title' => 'User | Cantik Fisik',
	// 			'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">RO</a> -> <b>Ubah Data</b>',
	// 			'validation' => \Config\Services::validation(),
	// 			'indik' => $this->ropk_kegiatan_sub->find($id),
	// 			'satuan' => $this->satuan->satuan(),
	// 			'db' => \Config\Database::connect(),
	// 		];
	// 		echo view('user/Ropk/ropk_fisik_kegiatan_sub_edit', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	public function ropk_fisik_kegiatan_sub_update()
	{
		if (has_permission('User')) :
			if (!$this->validate([
				'satuan' => ['rules' => 'required', 'errors' => ['required' => 'harus di isi']],

			])) {
				return redirect()->back()->withInput();
			}

			$this->ropk_kegiatan_sub->save([
				'id_ropk_fisik_rkpd_kegiatan_sub' => $this->request->getVar('id'),
				'satuan' => $this->request->getVar('satuan'),
				't_tahun' => $this->request->getVar('t_tahun'),
				'rp_tahun' => $this->request->getVar('rp_tahun'),
				'lokasi' => $this->request->getVar('lokasi'),
				'sumber_dana' => $this->request->getVar('sumber_dana'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ropk/ropk_kegiatan_sub/fisik');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// public function import_rkpd()
	// {
	// 	if (has_permission('User')) :
	// 		$data = [
	// 			'gr' => 'ropk',
	// 			'mn' => 'ropk_fisik',
	// 			'title' => 'User | RA',
	// 			'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">RO</a> -> <b>Import Data</b>',
	// 		];
	// 		echo view('user/Ropk/ropk_fisik_kegiatan_sub_import', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	public function export_rkpd()
	{
		$data = $this->ropk_organisasi_kegiatan_sub->where([
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan' => $_SESSION['perubahan'],
		])->findAll();

		$spreadsheet = new Spreadsheet();

		$tahun = $_SESSION['tahun'];

		$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Ropk Organisasi Kegiatan')
			->setCellValue('B1', 'Ropk Organisasi Sub Kegiatan')
			->setCellValue('C1', 'Ropk Organisasi Indikator Sub Kegiatan')
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
		$filename =  'Ropk Organisasi Sub Kegiatan (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
	public function simpanExcel_rkpd()
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

			$this->ropk_kegiatan_sub->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/ropk/ropk_kegiatan_sub/fisik');
	}
	/* ------------------------------------Data RKPD Sub Kegiatan-----------------------------------
	---------------------------------------Data RKPD Sub Kegiatan-----------------------------------
	---------------------------------------Data RKPD Sub Kegiatan-----------------------------------
	---------------------------------------Data RKPD Sub Kegiatan-------------------------------- */
	// --------------------------------------------------------------------------
	public function import($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ropk',
				'mn' => 'ropk_fisik',
				'title' => 'User | Cantik Fisik',
				'lok' => 'Sub Kegiatan -> <a onclick="history.back(-1)" href="#">Cantik Fisik</a> -> <b>Import Data</b>',
				'DT' => $this->ropk_kegiatan_sub->find($id),
			];
			echo view('user/Ropk/ropk_fisik_import', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function export()
	{
		$data = $this->ropk_organisasi->where([
			'rkpd_kegiatan' => $_GET['k'],
			'rkpd_kegiatan_sub' => $_GET['s'],
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan' => $_SESSION['perubahan'],
		])->findAll();

		$spreadsheet = new Spreadsheet();

		$tahun = $_SESSION['tahun'];

		$spreadsheet->getActiveSheet()->getStyle('A1:T1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Rkpd Kegiatan')
			->setCellValue('B1', 'Rkpd Sub Kegiatan')
			->setCellValue('C1', 'Indikator Sub Kegiatan (keluaran)')
			->setCellValue('D1', 'Tahap Aktivitas')
			->setCellValue('E1', 'Sasaran Tahap Aktivitas')
			->setCellValue('F1', 'Target Tahap Aktivitas')
			->setCellValue('G1', 'Satuan Target')
			->setCellValue('H1', 'Bobot Acuan')
			->setCellValue('I1', 'B1')
			->setCellValue('J1', 'B2')
			->setCellValue('K1', 'B3')
			->setCellValue('L1', 'B4')
			->setCellValue('M1', 'B5')
			->setCellValue('N1', 'B6')
			->setCellValue('O1', 'B7')
			->setCellValue('P1', 'B8')
			->setCellValue('Q1', 'B9')
			->setCellValue('R1', 'B10')
			->setCellValue('S1', 'B11')
			->setCellValue('T1', 'B12');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $_GET['k'])
				->setCellValue('B' . $column, $_GET['s'])
				->setCellValue('C' . $column, $row['rkpd_indikator_kegiatan_sub'])
				->setCellValue('D' . $column, $row['ropk_tahap_aktivitas'])
				->setCellValue('E' . $column, $row['ropk_sasaran'])
				->setCellValue('F' . $column, $row['ropk_sasaran_target'])
				->setCellValue('G' . $column, $row['ropk_sasaran_satuan'])
				->setCellValue('H' . $column, $row['ropk_bobot_acuan'])
				->setCellValue('I' . $column, $row['b1'])
				->setCellValue('J' . $column, $row['b2'])
				->setCellValue('K' . $column, $row['b3'])
				->setCellValue('L' . $column, $row['b4'])
				->setCellValue('M' . $column, $row['b5'])
				->setCellValue('N' . $column, $row['b6'])
				->setCellValue('O' . $column, $row['b7'])
				->setCellValue('P' . $column, $row['b8'])
				->setCellValue('Q' . $column, $row['b9'])
				->setCellValue('R' . $column, $row['b10'])
				->setCellValue('S' . $column, $row['b11'])
				->setCellValue('T' . $column, $row['b12']);

			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Cantik Fisik- ' . substr($_GET['s'], 0, 200) . '... (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
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
				'rkpd_kegiatan' => $row[0],
				'rkpd_kegiatan_sub' => $row[1],
				'rkpd_indikator_kegiatan_sub' => $row[2],
				'ropk_tahap_aktivitas' => $row[3],
				'ropk_sasaran' => $row[4],
				'ropk_sasaran_target' => $row[5],
				'ropk_sasaran_satuan' => $row[6],
				'ropk_bobot_acuan' => $row[7],
				'b1' => $row[8],
				'b2' => $row[9],
				'b3' => $row[10],
				'b4' => $row[11],
				'b5' => $row[12],
				'b6' => $row[13],
				'b7' => $row[14],
				'b8' => $row[15],
				'b9' => $row[16],
				'b10' => $row[17],
				'b11' => $row[18],
				'b12' => $row[19],

				'tahun' => $_SESSION['tahun'],
				'perubahan' => $_SESSION['perubahan'],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			];

			$this->ropk_fisik->insert($simpandata);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() . '/user/ropk/ropk_fisik/fisik/' . $this->request->getVar('id'),);
	}
	// ---------------------------------------------------------------
	public function export_edit()
	{
		$data = $this->ropk_fisik->where([
			'rkpd_kegiatan' => $_GET['k'],
			'rkpd_kegiatan_sub' => $_GET['s'],
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan' => $_SESSION['perubahan']
		])->findAll();

		$spreadsheet = new Spreadsheet();

		$spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Rkpd Kegiatan')
			->setCellValue('C1', 'Rkpd Sub Kegiatan')
			->setCellValue('D1', 'Indikator Sub Kegiatan (keluaran)')
			->setCellValue('E1', 'RO Tahap Aktivitas')
			->setCellValue('F1', 'Sasaran Tahap Aktivitas')
			->setCellValue('G1', 'Target Tahap Aktivitas')
			->setCellValue('H1', 'Satuan Target')
			->setCellValue('I1', 'Bobot Acuan')
			->setCellValue('J1', 'B1')
			->setCellValue('K1', 'B2')
			->setCellValue('L1', 'B3')
			->setCellValue('M1', 'B4')
			->setCellValue('N1', 'B5')
			->setCellValue('O1', 'B6')
			->setCellValue('P1', 'B7')
			->setCellValue('Q1', 'B8')
			->setCellValue('R1', 'B9')
			->setCellValue('S1', 'B10')
			->setCellValue('T1', 'B11')
			->setCellValue('U1', 'B12');

		$column = 2;

		foreach ($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $column, $row['id_ropk_fisik'])
				->setCellValue('B' . $column, $row['rkpd_kegiatan'])
				->setCellValue('C' . $column, $row['rkpd_kegiatan_sub'])
				->setCellValue('D' . $column, $row['rkpd_indikator_kegiatan_sub'])
				->setCellValue('E' . $column, $row['ropk_tahap_aktivitas'])
				->setCellValue('F' . $column, $row['ropk_sasaran'])
				->setCellValue('G' . $column, $row['ropk_sasaran_target'])
				->setCellValue('H' . $column, $row['ropk_sasaran_satuan'])
				->setCellValue('I' . $column, $row['ropk_bobot_acuan'])
				->setCellValue('J' . $column, $row['b1'])
				->setCellValue('K' . $column, $row['b2'])
				->setCellValue('L' . $column, $row['b3'])
				->setCellValue('M' . $column, $row['b4'])
				->setCellValue('N' . $column, $row['b5'])
				->setCellValue('O' . $column, $row['b6'])
				->setCellValue('P' . $column, $row['b7'])
				->setCellValue('Q' . $column, $row['b8'])
				->setCellValue('R' . $column, $row['b9'])
				->setCellValue('S' . $column, $row['b10'])
				->setCellValue('T' . $column, $row['b11'])
				->setCellValue('U' . $column, $row['b12']);

			$spreadsheet->getActiveSheet()->getStyle('A' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$spreadsheet->getActiveSheet()->getStyle('B' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$spreadsheet->getActiveSheet()->getStyle('C' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$spreadsheet->getActiveSheet()->getStyle('D' . $column)->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB('FFFF0000');
			$column++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename =  'Edit RK - ' . substr($_GET['s'], 0, 200) . '... (' . $_SESSION['tahun'] . ') - ' . date('Y-m-d-His');
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
				'rkpd_kegiatan' => $row[1],
				'rkpd_kegiatan_sub' => $row[2],
				'rkpd_indikator_kegiatan_sub' => $row[3],
				'ropk_tahap_aktivitas' => $row[4],
				'ropk_sasaran' => $row[5],
				'ropk_sasaran_target' => $row[6],
				'ropk_sasaran_satuan' => $row[7],
				'ropk_bobot_acuan' => $row[8],
				'b1' => $row[9],
				'b2' => $row[10],
				'b3' => $row[11],
				'b4' => $row[12],
				'b5' => $row[13],
				'b6' => $row[14],
				'b7' => $row[15],
				'b8' => $row[16],
				'b9' => $row[17],
				'b10' => $row[18],
				'b11' => $row[19],
				'b12' => $row[20],

				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			];
			$id = [
				'tahun' => $_SESSION['tahun'],
				'id_ropk_fisik' => $row[0],
				'opd_id' => user()->opd_id,
			];
			$this->ropk_fisik->set($simpandata)->where($id)->update();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			// }
		}

		return redirect()->to(base_url() .  '/user/ropk/ropk_fisik/fisik/' . $this->request->getVar('id'),);
	}
}
