<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SwapiService;

class SwapiApiController extends Controller
{	
		// Use dependency injection to load the swapi service
    public function __construct(SwapiService $swapiService) {
    	$this->swapiService = $swapiService;
    }

    public function index(Request $request) {

    	// If no default page number default to 1
    	$pageNo = ! empty( $request->page ) ? (int) $request->page : 1;

    	// Default to empty
    	$keyword = $request->search ? $request->search : '';

    	// Call swapi service to get data
			$people = $this->swapiService->getPeople($pageNo, $keyword);

			// if result is not false, calculate pages
			if($people !== false){

				$pages = [
					'page' => $pageNo, // current page number
					'totalPages' => ceil( $people['count'] / 10 ) // use the ceil function to round the number
				];

			}else{
				$pages = null;
			}

			// return view
    	return view('swapi.people_list', compact('people', 'pages', 'keyword'));

    }
}
