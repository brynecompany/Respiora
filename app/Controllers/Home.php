<?php

namespace App\Controllers;

class Home extends BaseController
{
    /* public function sidebarLayl()
    {
        return view('sidebar_layl');
    } */

    public function sidebarLayl($page = 'dashboard')
    {
        return view('sidebar_layl', [
            'page' => $page
    ]);}
    
    public function profil()
    {
        return view('profil');
    }
}
