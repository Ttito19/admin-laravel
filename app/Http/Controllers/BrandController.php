<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $brands = Brand::all();
        // return $brands;
        return view('brand.index');
    }
    public function fechtBrands()
    {
        $brands = Brand::all();

        return datatables()->of($brands)->addColumn('action', function ($row) {
            $html = '<a data-id="' . $row->id . '" id="btn-edit"  data-toggle="modal" data-target="#editBrands"    ><i class="fas fa-edit"></i></a> ';
            $html .= '<a data-id="' . $row->id . '" id="btn-delete"     ><i class="fas fa-trash text-danger"></i> </a></a>';
            return $html;
        })->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $validator = Validator::make($request->All(), [
            'txtname' => 'required|max:50',
            'txtimage' => 'required|image|mimes:jpeg,png,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator
                // 'errors' => $validator->message()
            ]);
        } else {
            $brands = new Brand;
            $brands->name = $request->input('txtname');
            if ($request->hasFile('txtimage')) {
                $file = $request->file('txtimage');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/brands/', $filename);
                $brands->image = $filename;
            }
            $brands->save();
            return response()->json([
                'status' => 200,
                'message' => 'Marca agregado correctamente',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            return response()->json([
                'status' => 200,
                'brand' => $brand
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'brand not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);

            if ($brand) {
                $brand->name = $request->input('txtname');
                if ($request->hasFile('txtimage')) {
                    $path = 'uploads/brands/' . $brand->image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $file = $request->file('txtimage');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/brands/', $filename);
                    $brand->image = $filename;
                }
                $brand->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Marca actualizado correctamente',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Marca no encontrada',
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $path = 'uploads/brands/' . $brand->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $brand->delete();
            return response()->json([
                'status' => 200,
                'message' => "Marca eliminado correctamente"
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Marca no encontrada'
            ]);
        }

    }
}
