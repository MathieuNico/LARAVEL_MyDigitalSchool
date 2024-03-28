<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Flux;

use Illuminate\Http\Request;
use SimplePie;


class CategoryController extends Controller
{

    public function index(){
        $categories = Categorie::where('parent_id', null)->with('children', 'children.flux')->where('user_id', auth()->user()->id)->get();
        $items = []; // Initialisez un tableau vide pour stocker les éléments du flux RSS
        $tabflux = [];
        foreach ($categories as $category) {
            foreach ($category->children as $child){
                foreach ($child->flux as $flux){
                    if (!empty($flux)){
                        $feed = new SimplePie();
                        $feed->set_feed_url($flux->flux); // Utilisez l'URL du flux RSS associé
                        $feed->enable_cache(false); // Désactiver le cache pour éviter les problèmes de mise en cache
                        $feed->init();
                        $items = array_merge($items, $feed->get_items()); // Ajoutez les éléments de flux au tableau $items
                    }  
                }
            }
        }
        return view('dashboard', compact('categories', 'items'));
    }

    public function showCategory(){
        $categories = Categorie::where('parent_id', null)->with('children')->where('user_id', auth()->user()->id)->get();
        return view('categories.index', compact('categories'));
    }

    public function show($id){
        $categories = Categorie::where('parent_id', null)->with('children', 'children.flux')->where('user_id', auth()->user()->id)->get();
        $category = Categorie::with('flux')->where('id', $id)->first();
        $flux_rss = Flux::where('category_id', $id)->get();
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

    public function destroysource(Request $request){
        $fluxId = $request->input('flux_id');
        $flux = Flux::find($fluxId);
        if($flux){
            // Supprimez le flux
            $flux->delete();
            // Redirigez l'utilisateur vers la page des catégories après la suppression
            return redirect()->route('categories.index');
        }
        return redirect()->route('categories.index');
    }

    public function destroysourcebyId(Request $request,$id){
        $flux = Flux::find($id);
        $flux->delete();

        return redirect()->route('categories.flux');

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
        $category->user_id = auth()->user()->id;
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

    public function showFlux(){
        $categories = Categorie::where('parent_id', null)->with('children', 'children.flux')->where('user_id', auth()->user()->id)->get();
        $category = Categorie::whereNotNull('parent_id')->with('flux')->where('user_id', auth()->user()->id)->get();
    
        return view('categories.flux', compact('categories','category'));
    }
}

