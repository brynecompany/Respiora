<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class RoleSelectionController extends Controller
{
    public function index()
    {
        return view('role_selection');
    }
}