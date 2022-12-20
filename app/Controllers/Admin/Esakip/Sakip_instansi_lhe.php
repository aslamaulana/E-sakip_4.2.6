<?php

namespace App\Controllers\Admin\Esakip;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\Esakip\Model_sakip_instansi;
use App\Models\Admin\Esakip\Model_sakip_instansi_jawaban;
use App\Models\Admin\Esakip\Model_sakip_instansi_jawaban_lhe;
use App\Models\Admin\Esakip\Model_sakip_instansi_jawaban_verifikasi;
use App\Models\Admin\Esakip\Model_sakip_instansi_jawaban_verifikasi_lhe;

class Sakip_instansi_lhe extends BaseController
{
	protected $sakip;

	public function __construct()
	{
		$this->sakip = new Model_sakip_instansi();
		$this->jawaban = new Model_sakip_instansi_jawaban_lhe();
		$this->jawaban_berjalan = new Model_sakip_instansi_jawaban();
		$this->verifikasi = new Model_sakip_instansi_jawaban_verifikasi_lhe();
		$this->verifikasi_berjalan = new Model_sakip_instansi_jawaban_verifikasi();
		$this->bidang = new Model_bidang(); /* model opd */
	}
	public function data($id)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'esakip-v',
				'mn' => 'a-instansi-lhe',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<b>SAKIP-LKE-Instansi</b>',
				'sakip' => $this->sakip->sakip_instansi()->getWhere(['tb_sakip_instansi.tahun' => $_SESSION['tahun']])->getResultArray(),
				'opd_id' => $id,
				'bidang' => $this->bidang->find($id),
				'db' => \Config\Database::connect(),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('admin/Esakip/sakip_instansi_lhe', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function tetapkan_lhe()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :

			$data = $this->jawaban_berjalan->getWhere(['tb_sakip_instansi_jawaban.tahun' => $_SESSION['tahun']])->getResultArray();
			foreach ($data as $key => $val) {
				$result[] = array(
					'id_sakip_instansi_jawaban' => $data[$key]['id_sakip_instansi_jawaban'],
					'sakip_instansi_id' => $data[$key]['sakip_instansi_id'],
					'jawaban' => $data[$key]['jawaban'],
					'link_keterangan' => $data[$key]['link_keterangan'],
					'link_1' => $data[$key]['link_1'],
					'link_2' => $data[$key]['link_2'],
					'link_3' => $data[$key]['link_3'],
					'catatan' => $data[$key]['catatan'],
					'nilai' => $data[$key]['nilai'],
					'opd_id' => $data[$key]['opd_id'],
					'tahun' => $data[$key]['tahun'],
					'created_by' => user()->full_name,
				);
			}
			$data1 = $this->verifikasi_berjalan->getWhere(['tb_sakip_instansi_jawaban_verifikasi.tahun' => $_SESSION['tahun']])->getResultArray();
			foreach ($data1 as $key => $val) {
				$result1[] = array(
					'id_sakip_instansi_jawaban_verifikasi' => $data1[$key]['id_sakip_instansi_jawaban_verifikasi'],
					'sakip_instansi_jawaban_id' => $data1[$key]['sakip_instansi_jawaban_id'],
					'verifikasi' => $data1[$key]['verifikasi'],
					'verifikasi_keterangan' => $data1[$key]['verifikasi_keterangan'],
					'nm_verifikator' => $data1[$key]['nm_verifikator'],
					'opd_id' => $data1[$key]['opd_id'],
					'tahun' => $data1[$key]['tahun'],
					'created_by' => user()->full_name,
				);
			}

			$this->jawaban->insertBatch($result);
			$this->verifikasi->insertBatch($result1);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/esakip/opd_data_lhe');


		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_instansi_history($id, $opd_id)
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :
			$data = [
				'gr' => 'esakip-v',
				'mn' => 'a-instansi-lhe',
				'title' => 'SAKIP-LKE-Instansi',
				'lok' => '<a onclick="history.back(-1)" href="#">SAKIP-LKE-Instansi</a> -> <b>History</b>',
				'sakip' => $this->jawaban
					->select('tb_sakip_instansi_jawaban_lhe.*, tb_sakip_instansi_jawaban_verifikasi_lhe.verifikasi_keterangan')
					->distinct('tb_sakip_instansi_jawaban_lhe.*, tb_sakip_instansi_jawaban_verifikasi_lhe.verifikasi_keterangan')
					->orderBy('id_sakip_instansi_jawaban', 'ASC')
					->join('tb_sakip_instansi_jawaban_verifikasi_lhe', 'tb_sakip_instansi_jawaban_lhe.id_sakip_instansi_jawaban = tb_sakip_instansi_jawaban_verifikasi_lhe.sakip_instansi_jawaban_id', 'LEFT')
					->where(['sakip_instansi_id' => $id, 'tb_sakip_instansi_jawaban_lhe.opd_id' => $opd_id])->findAll(),
				'komponen' => $this->sakip->sakip_instansi()->getWhere(['id_sakip_instansi' => $id])->getRowArray(),
				'db' => \Config\Database::connect(),
				'bidang' => $this->bidang->find($opd_id),
			];
			// dd(current_url() . ' | ' . uri_string());
			echo view('admin/Esakip/sakip_instansi_history_lhe', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function sakip_jawaban_nilai()
	{
		if (has_permission('Admin') || has_permission('Verifikator')) :

			$this->jawaban->save([
				'id_sakip_instansi_jawaban' => $this->request->getVar('id'),
				'nilai' => $this->request->getVar('nilai'),
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();

		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
