<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $data['active'] = 'Users';
        $data['sub_active'] = '';
        $data['sub_active1'] = '';
        $data['users'] = User::All();
        return view("admin.users", $data);
    }

}
