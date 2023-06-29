<?php

namespace App\Http\Controllers;

use App\Services\BringApiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiGeodataController extends Controller   
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $geodataService = new BringApiService();
        return $geodataService->get('postal-codes');
    }

}
