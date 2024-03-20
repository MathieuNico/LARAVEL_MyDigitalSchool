<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Flux;

use Illuminate\Http\Request;
use SimplePie;


class CategoryController extends Controller
{

    public function index(){
        $categories = Categorie::where('parent_id', null)->with('children')->get();
        return view('dashboard', compact('categories'));
    }

    public function showCategory(){
        $categories = Categorie::where('parent_id', null)->with('children')->get();
        return view('categories.index', compact('categories'));
    }

    public function show($id){
        $categories = Categorie::where('parent_id', null)->with('children')->get();
        $category = Categorie::find($id);
        $flux_rss = Flux::where('category_id', $category->id)->get();
        $items = []; // Initialisez un tableau vide pour stocker les éléments du flux RSS
        foreach ($flux_rss as $flux) {
            $feed = new SimplePie();
            $feed->set_feed_url($flux->flux); // Utilisez l'URL du flux RSS associé
            $feed->enable_cache(false); // Désactiver le cache pour éviter les problèmes de mise en cache
            $feed->init();
            $items = array_merge($items, $feed->get_items()); // Ajoutez les éléments de flux au tableau $items
        }
        return view('categories.show', compact('categories', 'category', 'items'));
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
        $category = new Categorie();
        $category->name = $request->input('name');
        
        // Si une catégorie parent a été sélectionnée, définissez le parent_id en conséquence
        if ($request->has('parent_id')) {
            $category->parent_id = $request->input('parent_id');
        }
        
        // Enregistrez la catégorie dans la base de données
        $category->save();
        
        // Redirigez l'utilisateur vers la liste des catégories
        return redirect()->route('categories.index');
    }

    public function storeFlux(Request $request, $categoryId)
    {

        $flux = new Flux();
        $flux->name = $request->input('name');
        $flux->flux = $request->input('flux');
        $flux->category_id = $categoryId;
        
        $flux->save();

        return redirect()->route('categories.index');
    }
}

