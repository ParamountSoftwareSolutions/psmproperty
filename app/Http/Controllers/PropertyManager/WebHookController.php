<?php

namespace App\Http\Controllers\PropertyManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class WebHookController extends Controller
{
    public function index()
    {
        return view('property_manager.webhook.index');
    }

    public function show()
    {
        $challenge = $_REQUEST['hub_challenge'];
        $verify_token = $_REQUEST['hub_verify_token'];

        if ($verify_token === 'abc123') {
            echo $challenge;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        error_log(print_r($input, true));
    }
}
