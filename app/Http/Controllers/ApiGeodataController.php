<?php

namespace App\Http\Controllers;

use App\Services\BringApiService;
use App\Services\Parser;
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
        $code = $request->post()['params']['code'];
        $parsed = Parser::fromPostalCode($geodataService->get('postal-codes/' . $code));
        return $parsed;
    }

}
