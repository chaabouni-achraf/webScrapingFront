<?php

use Illuminate\Database\Seeder;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $produit= new \App\Produit();
      $produit->nom="Brûleur d'encres en cuivre";
      $produit->description="Nouvelle collection";
      $produit->Prix=69;
      $produit->Qte=3;
      $produit->Photo_principale="Brûleur d'encres en cuivre.jpg";
      $produit->category_id=8;
      $produit->user_id=6;
      $produit->save();

         $produit= new \App\Produit();
         $produit->nom="Suspension mural en macramé";
         $produit->description="Nouvelle collection de suspension";
         $produit->Prix=62;
         $produit->Qte=8;
         $produit->Photo_principale="Suspension mural en macramé.jpg";
         $produit->category_id=21;
         $produit->user_id=7;
         $produit->save();


       // $produit= new \App\Produit();
       // $produit->nom="Miroir original";
       // $produit->description="Nouvelle collection de miroir";
       // $produit->Prix=169;
       // $produit->Qte=8;
       // $produit->Photo_principale="k8.jpg";
        //$produit->category_id=5;
       // $produit->save();

         $produit= new \App\Produit();
         $produit->nom="Collection Photos";
         $produit->description="support Photos";
         $produit->Prix=87;
         $produit->Qte=8;
         $produit->Photo_principale="sac-en-half.png";
         $produit->category_id=15;
         $produit->user_id=7;
         $produit->save();

         $produit= new \App\Produit();
         $produit->nom="Peinture à l'huile";
         $produit->description="Peinture à l'huile";
         $produit->Prix=220;
         $produit->Qte=1;
         $produit->Photo_principale="Peinture Sidi Bousaid.jpg";
         $produit->category_id=20;
         $produit->user_id=6;
         $produit->save();

        $produit= new \App\Produit();
        $produit->nom="Collier en perles";
        $produit->description="Collier";
        $produit->Prix=22;
        $produit->Qte=10;
        $produit->Photo_principale="collier-en-perles.png";
        $produit->category_id=14;
        $produit->user_id=7;
        $produit->save();
        

       $produit= new \App\Produit();
       $produit->nom="Miroir original appartient sous categorie test";
      $produit->description="Nouvelle collection de miroir";
      $produit->Prix=169;
      $produit->Qte=8;
      $produit->Photo_principale="k8.jpg";
      $produit->category_id=16;
      $produit->user_id=6;
      $produit->save();

       

       $produit= new \App\Produit();
        $produit->nom="Collection Photos";
       $produit->description="support Photos";
        $produit->Prix=87;
       $produit->Qte=8;
        $produit->Photo_principale="kk.jpg";
       $produit->category_id=7;
       $produit->user_id=6;
       $produit->save();


        

    }
}
