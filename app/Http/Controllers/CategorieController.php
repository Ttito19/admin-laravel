<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
// use Yajra\Datatables\Datatables;


class CategorieController extends Controller
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
        // $categories = Categorie::all();
        // return view('categorie.index')->with('categories', $categories);
        // retornamos la vista
        return view("categorie.index");
    }

    public function fechtcategorias()
    {
        $categories = Categorie::all();
        // return response()->json([
        //     'categorie' => $categories,
        // ]);
        return datatables()->of($categories)->addColumn('action', function ($row) {
            $html = '<a data-id="' . $row->id . '" id="btn-edit"  data-toggle="modal" data-target="#editacategorie"    ><i class="fas fa-edit"></i></a> ';
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
        // Se etorna la vista 
        // return view('categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'name' => 'required', 'txtimage' => 'required|image|mimes:jpeg,png,svg|max:1024'
        // ]);

        // $categorie = $request->All();


        // if ($image = $request->file('txtimage')) {
        //     $rutasaveImage = 'imagen/categorie/';
        //     // getClientOriginalExtension te obtine la extención original del archivo
        //     $imgcategorie = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($rutasaveImage, $imgcategorie);
        //     $categorie['image'] = "$imgcategorie";
        // }
        // Categorie::create($categorie);
        // return redirect('/categorie');


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
            $categorie = new Categorie;
            $categorie->name = $request->input('txtname');
            if ($request->hasFile('txtimage')) {
                $file = $request->file('txtimage');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/categorie/', $filename);
                $categorie->image = $filename;
            }
            $categorie->save();
            return response()->json([
                'status' => 200,
                'message' => 'Categoría agregado correctamente',
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
    // public function edit($id)
    // {
    //     $categorie = Categorie::find($id);
    //     return view('categorie.edit')->with('categorie', $categorie);
    // }
    public function edit($id)
    {
        $categorie = Categorie::find($id);
        if ($categorie) {
            return response()->json([
                'status' => 200,
                'categorie' => $categorie
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Categorie not found'
            ]);
        }

        // return view('categorie.edit', compact('categorie'));
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
      
        // $validator = Validator::make($request->All(), [
        //     'txtname' => 'required|max:50',
        //     'txtimage' => 'required|image|mimes:jpeg,png,svg|max:1024',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => $validator,
        //         // 'errors' => $validator->message()
        //     ]);
        // } else {
            $categorie = Categorie::find($id);

            if ($categorie) {
                $categorie->name = $request->input('txtname');
                if ($request->hasFile('txtimage')) {
                    $path = 'uploads/categorie/' . $categorie->image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $file = $request->file('txtimage');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/categorie/', $filename);
                    $categorie->image = $filename;
                }
                $categorie->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Categoría actualizado correctamente',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Categoría no encontrada',
                ]);
            }
        // }
          // $request->validate([
        //     'name' => 'required', 'txtimage' => 'required|image|mimes:jpeg,png,svg|max:1024'
        // ]);

        // $cat = $request->All();


        // if ($image =
        //     $request->file('txtimage')
        // ) {
        //     $rutasaveImage = 'imagen/categorie/';
        //     // getClientOriginalExtension te obtine la extención original del archivo
        //     $imgcategorie = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($rutasaveImage, $imgcategorie);
        //     $cat['image'] = "$imgcategorie";
        // } else {
        //     unset($cat['image']);
        // }
        // $categorie->update($cat);
        // return redirect('/categorie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $categories = Categorie::find($id);
    //     $categories->delete();
    //     return redirect('/categorie');
    // }
    public function destroy($id)
    {
        // $categorie->delete();
        // return redirect('/categorie');

        $categorie = Categorie::find($id);
        if ($categorie) {
            $path = 'uploads/categorie/' . $categorie->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $categorie->delete();
            return response()->json([
                'status' => 200,
                'message' => "Categoría eliminado correctamente"
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Categoría no encontrada'
            ]);
        }

    }
}
