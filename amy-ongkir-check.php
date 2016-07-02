<?php

function amy_ongkir_load_city()
{
	if ( ! current_user_can( 'manage_options' ) ) {
		return wp_send_json_error( 'You are not allow to do this.' );
	}

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "key: ca332ed5927b62b9e488ffdbd583a135"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$response2 = json_decode($response);

	$data = array(
		'response' => $response2,
	);

	wp_send_json_success($data);
	//json_decode($response);
}

add_action( 'wp_ajax_ongkir_load_city', 'amy_ongkir_load_city' );

function amy_ongkir_check() {

	// if ( ! check_ajax_referer( 'wp-ongkir-check', 'security' ) ) {
	// 	return wp_send_json_error( 'Invalid Nonce' );
	// }

	if ( ! current_user_can( 'manage_options' ) ) {
		return wp_send_json_error( 'You are not allow to do this.' );
	}

	$company_name = $_POST['company_name'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$kg = $_POST['kg'];



	$curl = curl_init();


	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=$from&destination=$to&weight=$kg&courier=$company_name",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key: ca332ed5927b62b9e488ffdbd583a135"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	// if ($err) {
	//   echo "cURL Error #:" . $err;
	// } else {
	//   echo $response;
	// }
	
	$response2 = json_decode($response);

	$data = array(
		'response' => $response2,
	);

	wp_send_json_success($data);

}

add_action( 'wp_ajax_ongkir_check', 'amy_ongkir_check' );
 ?>