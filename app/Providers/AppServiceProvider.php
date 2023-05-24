<?php

namespace App\Providers;
use App\Http\ViewComposers\HeaderComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Panier;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
view()->composer(['shopping','Profil/edit','about','Myshop','Shop.ProductDetail','shopping.forsales', 'home1', 'index','shopping.Productsforsales', 'shop.Products', 'products.create','shop.By_user','shop.leftSide_shop','shop.Shop_initial','products.edit' ,'shopping.panier' ,'shopping.Checkout','shopping.commande','Contact','Booster' , 'shopping.ProductDetail','shopping.livraison','CGV' ,'shopping.alllivraison' ,'shopping.allcommande','allusers','Fournisseur/Mywebsite','Fournisseur.EditMyinfos','Fournisseur.AddMyinfos','ProductsFournisseur.create' ,'Fournisseur.ProductFrsDetail' ,'ProductsFournisseur.edit'], 
        HeaderComposer::class);



        view()->composer('shopping.panier', function ($view) {
            $user=Auth::user()->id;
            $paniers=Panier::where('user_id' , '=', $user)->get();
            $panierprixtotal = DB::select("SELECT prix from paniers,users,produits WHERE  paniers.produit_id=produits.id and users.id=paniers.user_id and paniers.user_id=$user");
            $prixtotal=collect($panierprixtotal)->sum('prix');
           // dd($prixtotal);
        
            $view->with('prixtotal',$prixtotal);

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    
}
