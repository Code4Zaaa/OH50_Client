<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function __invoke() {
        $isAdminActive = Admin::where('status', 'active')->exists();

        if($isAdminActive){
            return redirect('/');
        }
        return view("error");
    }
}
