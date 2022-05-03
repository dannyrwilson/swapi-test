<?php 
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SwapiService {

	// base url for swapi api.
	const BASE_URL = 'https://swapi.dev/api/';

	/**
	 * getPeople method
	 */
	public function getPeople($pageNo, $keyword) : array|bool {


		// append search if provided on query string
		$append = (string) (!is_null($keyword)) ? '&search='.$keyword : '';

		$response = Http::get(self::BASE_URL.'/people/?page='.$pageNo.$append);

		if( $response->successful() ) {

			// assign json array to var
			$jsonData = $response->json();

			// use count() method outside of forloop, so it's not calling the count method every iteration 
			$totalPeople = (int) count($jsonData['results']);

			// strip ID from URL provided
			for ($i=0; $i < $totalPeople; $i++) { 

				// use preg_replace to extract the ID from the string provided
				$jsonData['results'][$i]['id'] = (int) preg_replace('/[^0-9]/', '', $jsonData['results'][$i]['url']);

			}

			// return array
			return $jsonData;

		}else{

			// use the log facade to log the api error
			Log::alert('swapi api is down.');

			return false;
		}

	}

}
?>