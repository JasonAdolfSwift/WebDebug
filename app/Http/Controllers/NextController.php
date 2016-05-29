<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class NextController extends Controller
{
    //
    public $vars = array();
    public $var_adds = array();
    public $mem;

    public function index()
    {
        $run_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/run.sh";
        $output_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/output";
        $real_output_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/real_output";
        $process_file_path = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/public/process_file";

        $tmp = $_GET['var'];
        $respond = array();

        exec("$run_path n");

        if ( $tmp != "..." )
        {
            $respond['var'] = "";
            $output = "";
            $this->vars = explode(" ", $tmp);

            foreach ($this->vars as $var)
            {
                $output_file = fopen($output_path, "r");

                exec("$run_path p $var");

                exec("$process_file_path $output_path $real_output_path");

                $size = filesize($real_output_path);

                if ($size > 0)
                {
                    $real_output_file = fopen($real_output_path, "r");
                    $output =  fread($real_output_file, $size);
                    fclose($real_output_file);
                }

                $respond['var'] = strval($respond['var']).$var."==>".$output."\n";

                clearstatcache();
                fclose($output_file);
            }
        }

        $tmp = $_GET['var_add'];
        if ( $tmp != "..." )
        {
            $respond['var_add'] = "";
            $output = "";
            $this->var_adds = explode(" ", $tmp);

            foreach ($this->var_adds as $var_add)
            {
                $output_file = fopen($output_path, "r");

                exec("$run_path p address $var_add");

                exec("$process_file_path $output_path $real_output_path");

                $size = filesize($real_output_path);

                if ($size > 0)
                {
                    $real_output_file = fopen($real_output_path, "r");
                    $output =  fread($real_output_file, $size);
                    fclose($real_output_file);
                }

                $respond['var_add'] = strval($respond['var_add'])."&".$var_add."==>".$output."\n";

                clearstatcache();
                fclose($output_file);
            }

        }

        $tmp = $_GET['mem'];
        if ( $tmp != "..." )
        {
            $respond['mem'] = "";
            $output = "";
            $this->mem = $tmp;

            $output_file = fopen($output_path, "r");

            exec("$run_path x/44xw $this->mem");

            exec("$process_file_path $output_path $real_output_path");

            $size = filesize($real_output_path);

            if ($size > 0)
            {
                $real_output_file = fopen($real_output_path, "r");
                $output =  fread($real_output_file, $size);
                fclose($real_output_file);
            }

            $respond['mem'] = $output."\n";

            clearstatcache();
            fclose($output_file);
        }

        $respond = json_encode($respond);

        return $respond;
    }

    public function add()
    {
        $tmp = Input::get('var');
        if ( $tmp != "..." )
        {

            $this->vars = explode(" ", $tmp);
        }

        $tmp = Input::get('var_address');
        if ( $tmp != "..." )
        {
            $this->var_adds = explode(" ", $tmp);
        }

        $tmp = Input::get('memory');
        if ( $tmp != "..." )
        {
            $this->mem = $tmp;
        }

        $respond['vars'] = $this->vars;
        $respond['address'] = $this->var_adds;
        $respond['memory'] = $this->mem;

        $respond = json_encode($respond);

        return $respond;
    }

    public function stop()
    {
        $stop_script = "/Users/Jason/Desktop/EveryThing/Graduation/web_debug/storage/files/killall.sh";

        exec("$stop_script -k");

        $respond['msg'] = "Success";

        $respond = json_encode($respond);

        $_COOKIE['flag'] = 0;

        return $respond;
    }
}
