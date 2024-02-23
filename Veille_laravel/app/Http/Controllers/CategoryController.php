<?php

namespace App\Http\Controllers;
use App\Models\Categorie;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        $categories = Categorie::where('parent_id', null)->with('children')->get();
        return view('dashboard', compact('categories'));
    }

    public function showCategory(){
        $categories = Categorie::where('parent_id', null)->with('children')->get();
        return view('categories', compact('categories'));
    }

    public function update(Request $request,$id){
        $categories = Categorie::find($id);
        $categories->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id){
        $category = Categorie::find($id);
        $category->delete();

        return redirect()->route('categories.index');
    }

    public function create()
    {
        $parent_categories = Categorie::where('parent_id', null)->get();
        return view('categories.create', compact('parent_categories'));
    }

    public function store(Request $request)
    {
        Categorie::create($request->all());
        return redirect()->route('categories.index');
    }

    public function storeSubcategory(Request $request, $parent_id)
    {
        // Validation des données du formulaire

        $subcategory = new Categorie();
        $subcategory->parent_id = $parent_id; // Assignez l'ID du parent
        $subcategory->name = $request->input('name');
        // Autres attributs de la sous-catégorie

        $subcategory->save();

        return redirect()->route('categories.index')->with('success', 'Sous-catégorie créée avec succès.');
    }
}
