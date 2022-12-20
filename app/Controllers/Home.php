<?php

namespace App\Controllers;

use App\Models\Api\Model_token;

class Home extends BaseController
{
	protected $session;

	function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	/*
	 * ---------------------------------------------------
	 * index Dashboard
	 * ---------------------------------------------------
	 */
	public function index()
	{
		$data = [
			'gr' => 'home',
			'mn' => 'home',
			'title' => 'Tarasi Donan',
			'lok' => 'Dashboard',
		];
		// Pertama login jika tudak set tahun maka auto set tahun dan perubahan (tahun sekarang / murni)
		if (!isset($_SESSION['tahun'])) {
			try {
				$this->session->set('tahun', '2022');
			} catch (\Exception $e) {
			}
			return redirect()->to(base_url('/'))->with('tahun2', '2022');
		}

		//----Cek Token api apakah sudah kadaluarsa -----
		$client = \Config\Services::curlrequest();

		$id_token = '1';
		$model = new Model_token(); //Model data bases token
		$token = $model->getToken($id_token); //Mengambil token dari data base

		$tokenPart = explode(".", $token->token); //Pecah token ambil waktu expire
		$decode = json_decode(base64_decode($tokenPart[1]), true); //Ambil waktu expire data [1]

		if ($decode['exp'] <= time()) {
			$url = getenv('Api_Url') . "/api/login";
			$form_params = [
				'email' => getenv('Api_Email'),
				'password' => getenv('Api_Password')
			];
			$response = $client->request('post', $url, ['http_errors' => false, 'form_params' => $form_params]);
			$response = json_decode($response->getBody(), true);
			// dd($response);
			//Memasukan token baru ke databases;
			$model->save([
				'id' => $id_token,
				'token' => $response['token']
			]);
		}
		//-----------------------------------------------

		return view('dashboard', $data);
	}
	/*
	 * ---------------------------------------------------
	 * Set_Tahun
	 * fungsi untuk menetapkan tahun yang di pilih
	 * ---------------------------------------------------
	 */
	public function Set_Tahun($tahun)
	{
		$this->session->set('tahun', $tahun);

		return redirect()->to(base_url('/'))->with('tahun2', $tahun);
	}
	/*
	 * ---------------------------------------------------
	 * Set_perubahan
	 * fungsi untuk menetapkan perubahan (murni / perubahan)
	 * ---------------------------------------------------
	 */
	public function Set_perubahan($perubahan)
	{
		$i = $perubahan == 'Murni' ? 'Penetapan Ke I' : 'Penetapan Ke II';
		try {
			$this->session->set('perubahan', $perubahan);
		} catch (\Exception $e) {
		}
		return redirect()->to(base_url('/'))->with('perubahan2', $i);
	}
	/*
	 * ---------------------------------------------------
	 * Set maximun dan minimum container view
	 * ---------------------------------------------------
	 */
	public function max($id)
	{
		if ($id == 'max') {
			$this->session->set('max', 'maximized-card');
		} else {
			$this->session->remove('max');
		}

		return redirect()->back();
	}
}
