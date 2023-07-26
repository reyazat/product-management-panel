<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckAdmin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $payload = [
            'pageinfo' => [
                'title' => __('Dashboard'),
                'description' => 'description',
                'keywords' => 'keywords',
                'owner' => 'owner',
                'breadcrumbs' => [['Home'],['dashboard.index']
                ],
            ],

        ];
        return view('panel.dashboard', $payload);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
