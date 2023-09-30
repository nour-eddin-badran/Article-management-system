<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
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
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('datatables.index', [
            'columns' => [
                'Id',
                'Name',
                'Email',
            ]
        ]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {

    }
}
