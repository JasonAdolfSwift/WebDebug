<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DebugingController extends Controller
{
    //
    public function index()
    {
        $break_point = $_POST['break_point'];

        $exe_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/a.out";
        $out_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/output ";

        $run_gdb = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/run_gdb.sh";
        $run = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/run.sh";

        setcookie('flag', 0, 0, "/");
        $_COOKIE['flag'] = 0;

        if ( is_numeric($break_point) && $_COOKIE['flag'] == 0)
        {
            $_COOKIE['flag'] = 1;
            exec("$run_gdb $exe_path $out_path");
            $instruction = "b $break_point";

            exec("$run $instruction");

            exec("$run r");
        }

        $code_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/code.c";

        $code_file = fopen($code_path, "r");

        $code = "";
        if (filesize($code_path) > 0)
        {
            $code = fread($code_file, filesize($code_path));
        }

        return view('debuging')->with('code', $code);
    }
}
