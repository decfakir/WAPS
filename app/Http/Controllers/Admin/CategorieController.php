<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Traits\AuthUserViewSharedDataTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategorieController extends Controller
{
    use AuthUserViewSharedDataTrait;

    public function __construct()
    {
        // Call the shareViewData method
        $this->shareViewData();
    }

    public function index()
    {
        $Categories = Categorie::all();
        $totalCount = Categorie::all()->count();
        $activeCount = Categorie::where('status', 'active')->count();
        return view('admin.pages.categorie-index', compact('Categories', 'totalCount', 'activeCount'));
    }


    public function create()
    {
        return view('admin.pages.categorie-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'description' => 'required',
            'status' => 'required',
        ], []);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cat = new Categorie();
        $cat->nom = $request->nom;
        $cat->description = $request->description;
        $cat->status = $request->status;
        $cat->save();

        return redirect()->route('admin.categorie.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {

        if($request->id){

            $cat = Categorie::where('id',$request->id)->first();
                if($cat){

                    $validator = Validator::make($request->all(), [
                        'nom' => 'required',
                        'description' => 'required',
                        'status' => 'required',
                    ], []);
                    if ($validator->fails()) {
                        return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
                    }

                    $cat->nom = $request->nom;
                    $cat->description = $request->description;
                    $cat->status = $request->status;
                    $cat->save();

                }
        }
         return redirect()->route('admin.categorie.index')->with('success', 'Catégorie Modifer avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->id){
            $cat= Categorie::where('id',$request->id)->delete();
            return redirect()->route('admin.categorie.index')->with('success', 'Catégorie supprimer avec succès.');

        }
    }
}
