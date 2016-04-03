<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class CompileCodeController extends Controller
{
    public function index()
    {
        $code_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/code.c";
        $out_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/output";

        $code = $_POST['code'];
        $file = fopen($code_path, "w");
        if (fwrite($file, $code) == FALSE)
        {
            return "Error";
        }

        exec("gcc $code_path -g >&  $out_path", $output, $ret_val);

        if ($ret_val != 0)
        {
            $outfile = fopen($out_path, "r");
            $output = fread($outfile, filesize($out_path));
            fclose($outfile);
        }

        fclose($file);

        $data = [];
        $data['code'] = $code;
        $data['ret_val'] = $ret_val;
        $data['output'] = $output;

        return view('compile_result', $data);
    }
}
