<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use App\Http\Requests;

class HomePageController extends Controller
{
    //
    public function index()
    {
        return  view('home');
    }

    public function show()
    {
        $codes = Code::all();

        $resData['codes'] = $codes;

        return view('showCodes',$resData);
    }

    public function codeDetail()
    {
        $id = $_GET['id'];
        $code = Code::find($id);

        $resData['code'] = $code;
        return view('codeDetail', $resData);
    }
}
