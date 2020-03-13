<?php

namespace Modules\Produk\Http\Controllers;

/**
 * A class to get information of NotaController
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since Friday, March 13th, 2020
 */

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Nwidart\Modules\Routing\Controller;
use DataTables;
use DB;
use Carbon\Carbon;
use Auth;
use PDF;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('produk::nota.index');
    }
    function list()
    {
        $data = DB::table('penjualan')
            ->leftjoin('produk', 'produk.id', '=', 'penjualan.produkId')
            ->select([
                'penjualan.id',
                'produk.kode',
                'produk.name',
                'penjualan.qty',
                'penjualan.harga',
                'penjualan.created_at'
            ])
            ->where('userId', Auth::user()->id);
        return datatables($data)
            ->addIndexColumn()
            ->escapeColumns([])
            ->editColumn('harga', function ($data) {
                return "Rp. " . number_format($data->harga);
            })->editColumn('stok', function ($data) {
                return number_format($data->qty);
            })->editColumn('created_at', function ($data) {
                return tgl($data->created_at);
            })
            ->addColumn('action', function ($data) {

                return '
          <div class="hidden-sm hidden-xs action-buttons">

            <a class="green" data-rel="tooltip" title="Cetak" data-fancybox data-type="iframe" data-src="' . route('nota.show', [$data->id]) . '">
              <i class="ace-icon fa fa-print bigger-130"></i>
            </a>


          </div>

          <div class="hidden-md hidden-lg">
            <div class="inline pos-rel">
              <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
              </button>

              <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                <li>
                  <a data-fancybox data-type="iframe" data-src="' . route('produk.show', [$data->id]) . '"  class="tooltip-success" data-rel="tooltip" title="Beli">
                    <span class="green">
                      <i class="ace-icon fa fa-money bigger-120"></i>
                    </span>
                  </a>
                </li>

                <li>

                </li>
              </ul>
            </div>
          </div>';
            })

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('produk::create');
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
        $data = DB::table('penjualan')
            ->join('produk', 'produk.id', '=', 'penjualan.produkId')
            ->select([
                'produk.kode',
                'produk.name',
                'penjualan.qty',
                'penjualan.id',
                'penjualan.userId',
                'penjualan.harga',
                'penjualan.created_at'
            ])
            ->where('penjualan.id', $id)->first();

        $customPaper = [0, 0, 685.98, 396.85]; //array(0, 0, 567.00, 283.80);
        $pdf = PDF::loadView('produk::nota.show', compact('data'))->setPaper($customPaper, 'portait');
        return $pdf->stream();

        //return view('produk::nota.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('produk::edit');
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
