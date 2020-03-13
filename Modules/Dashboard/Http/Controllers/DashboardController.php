<?php

namespace Modules\Dashboard\Http\Controllers;
/**
 * A class to get information of DashboardController
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since Tuesday, January 14th, 2020
 */
 use Illuminate\Http\Request;
 use Illuminate\Http\Response;
 //use Illuminate\Routing\Controller;
 use Nwidart\Modules\Routing\Controller;
 use DataTables;
 use DB;
 use Carbon\Carbon;
 use Auth;
 
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
