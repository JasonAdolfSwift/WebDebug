<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ExecuteController extends Controller
{
    //
    public function index()
    {
        $exe_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/a.out";
        $out_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/output";
        
        exec("$exe_path &> $out_path", $output, $ret_val);

        $outfile = fopen($out_path, "r");
        $output = "";

        if (filesize($out_path) > 0)
        {
            $output = fread($outfile, filesize($out_path));
        }

        fclose($outfile);

        return $output;
    }
}
