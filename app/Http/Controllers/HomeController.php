<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function showWelcome(){
        // return 'Home Controllers Bui Trung Duc';
        return view ('index'); //liên kết đến view mới đầu tên hello
    }
}
