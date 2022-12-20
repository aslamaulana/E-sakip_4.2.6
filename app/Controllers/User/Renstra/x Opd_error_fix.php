<?php

namespace App\Controllers\User\Renstra;

use App\Controllers\BaseController;
use App\Models\User\Renstra\Model_opd_kegiatan_sub;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opd_error_fix extends BaseController
{
	protected $opd_kegiatan_sub, $satuan, $tahun;

	public function __construct()
	{
		$this->opd_kegiatan_sub = new Model_opd_kegiatan_sub();
	}
	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'Renstra',
				'mn' => 'opd_renstra_error_fix',
				'title' => 'User | Sub kegiatan',
				'lok' => '<b>Error Fix</b>',
				// 'opd_kegiatan_sub' => $this->opd_kegiatan_sub->kegiatan_sub(),
				// 'tahunA' => $this->tahun->tahunA(),
				// 'db' => \Config\Database::connect(),
			];
			echo view('user/Renstra/opd_error_fix', $data);
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
	public function export_edit()
	{
		$sisw = $this->opd_kegiatan_sub->where(['perubahan' => $_SESSION['perubahan'], 'opd_id' => user()->opd_id])->findAll();

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
		$filename =  'Sub Kegiatan-Backup-' . date('Y-m-d-His');
		$extension = 'Xlsx';
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename.{$extension}\"");
		$writer->save('php://output');
		exit();
	}
}
