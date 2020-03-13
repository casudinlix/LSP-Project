<?php

namespace Modules\Produk\Http\Controllers;

/**
 * A class to get information of ProdukController
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
use App\Produk;
use Modules\Master\Entities\Master\Produk as MasterProduk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('produk::produk.index');
    }
    function list()
    {
        return datatables(Produk::all())
            ->addIndexColumn()
            ->escapeColumns([])
            ->editColumn('harga', function ($data) {
                return "Rp. " . number_format($data->harga);
            })->editColumn('stok', function ($data) {
                return number_format($data->stok);
            })
            ->addColumn('action', function ($data) {
                if (Auth::user()->id != 1) {
                    return '
          <div class="hidden-sm hidden-xs action-buttons">

            <a class="green" data-rel="tooltip" title="Beli" href="' . route('produk.show', [$data->id]) . '" data-toggle="modal" data-target="#myModal">
              <i class="ace-icon fa fa-money bigger-130"></i>
            </a>


          </div>

          <div class="hidden-md hidden-lg">
            <div class="inline pos-rel">
              <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
              </button>

              <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                <li>
                  <a href="' . route('produk.show', [$data->id]) . '" data-toggle="modal" data-target="#myModal" class="tooltip-success" data-rel="tooltip" title="Beli">
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
                } else {
                    return '
          <div class="hidden-sm hidden-xs action-buttons">

            <a class="green" data-rel="tooltip" title="Edit" href="' . route('produk.edit', [$data->id]) . '" data-toggle="modal" data-target="#myModal">
              <i class="ace-icon fa fa-pencil bigger-130"></i>
            </a>

            <a class="red" href="javascript:void(0)" onclick="hapus(' . "'$data->id'" . ')">
              <i class="ace-icon fa fa-trash-o bigger-130"></i>
            </a>
          </div>

          <div class="hidden-md hidden-lg">
            <div class="inline pos-rel">
              <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
              </button>

              <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                <li>
                  <a href="' . route('produk.edit', [$data->id]) . '" data-toggle="modal" data-target="#myModal" class="tooltip-success" data-rel="tooltip" title="Edit">
                    <span class="green">
                      <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                  </a>
                </li>

                <li>
                  <a href="javascript:void(0)" onclick="hapus(' . "'$data->id'" . ')" class="tooltip-error" data-rel="tooltip" title="Delete">
                    <span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>';
                }
            })

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('produk::produk.create');
    }
    function beli(Request $req, $id)
    {
        $cek = Produk::find($id);

        if ($cek->stok < 1 || $req->beli > $cek->stok) {
            return response()->json(['status' => 'error', 'msg' => "Stok Tidak Cukup"]);
        } else {
            DB::table('penjualan')->insert([
                'userId' => Auth::user()->id,
                'produkId' => $id,
                'qty' => $req->beli,
                'harga' => $req->harga * $req->beli,
                'created_at' => now()
            ]);
            $totalqty = Produk::find($id);
            Produk::where('id', $id)->update([
                'stok' => $totalqty->stok - $req->beli
            ]);
            return response()->json(['status' => 'success', 'msg' => 'Sukses Melakukan transaksi']);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Produk::updateOrcreate(
            ['kode' => $request->kode],
            [
                'name' => $request->name,
                'stok' => $request->stok,
                'harga' => $request->harga
            ]
        );
        return response()->json(['status' => 'success']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data = Produk::find($id);
        return view('produk::produk.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Produk::find($id);
        return view('produk::produk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Produk::find($id)->update([
            'kode' => $request->kode,
            'name' => $request->name,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Produk::find($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
