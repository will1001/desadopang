<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\berita;
use App\pengumumandesa;
use App\jmlpend;
use App\statagamapend;
use App\statetnispend;
use App\statpendidikanpend;
use App\statpekerjaanpend;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $beritas= berita::paginate(10);
        $pengumumandesas= pengumumandesa::paginate(10);
        $jmlpends=jmlpend::paginate(10);
        $agamas= statagamapend::paginate(10);
        $pendidikans= statpendidikanpend::paginate(10);
        $pekerjaans= statpekerjaanpend::paginate(10);
        $etniss= statetnispend::paginate(10);

        return view('admin', ['beritas' => $beritas, 'pengumumandesas' => $pengumumandesas, 'agamas' => $agamas, 'jmlpends' => $jmlpends, 'pendidikans' => $pendidikans, 'etniss' => $etniss, 'pekerjaans' => $pekerjaans]);
    }
}
