<?php

use App\Models\Api\Model_token;

function akses_api($method, $url, $data)
{
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

	$headers = [
		'Authorization' => 'Bearer ' . $token->token
	];
	$response = $client->request($method, $url, ['headers' => $headers, 'http_errors' => false, 'form_params' => $data]);
	return $response;
}
