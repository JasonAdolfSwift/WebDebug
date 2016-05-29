<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;

use App\Http\Requests;

class DebugController extends Controller
{
    //
    public function index()
    {
        $code_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/code.c";

        $code_file = fopen($code_path, "r");

        $code = "";
        if (filesize($code_path) > 0)
        {
            $code = fread($code_file, filesize($code_path));
        }

        return view('start_debug')->with('code', $code);
    }

    public function save()
    {
        $code = $_POST["code"];

        $record = new Code();

        $record->code = $code;
        $record->error_type = "Null Pointer";

        $record->save();
    }
}
