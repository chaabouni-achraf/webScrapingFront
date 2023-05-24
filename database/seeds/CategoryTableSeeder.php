<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    //    $Category = new \App\Category();
    //  $Category->nom ="Maison&Décor";
    //    $Category->In_menu = 1;
     //   $Category->save();

    // $Category2 = new \App\Category();
     //   $Category2->nom ="Mode&Accessoires";
     //   $Category2->In_menu = 1;
     //   $Category2->save();

     //   $Category3 = new \App\Category();
      //  $Category3->nom ="Art&Peinture";
      //  $Category3->In_menu = 1;
     //   $Category3->save();

     //   $Category4 = new \App\Category();
     //   $Category4->nom ="Santé&Beauté";
     //   $Category4->In_menu = 1;
     //   $Category4->save();

     //   $Category5 = new \App\Category();
     //   $Category5->nom ="Art de la table";
     //   $Category5->In_menu = 0;
      //  $Category5->save();

        $Category5 = new \App\Category();
        $Category5->nom ="test";
        $Category5->In_menu = 0;
        $Category5->parent_id= 5;
        $Category5->save();

        //$Category6 = new \App\Category();
        //$Category6->nom ="Luminaire";
        //$Category6->In_menu = 0;
        //$Category6->parent_id= 5;
        //$Category6->save();

        //$Category7 = new \App\Category();
        //$Category7->nom ="Tapis&Clim";
        //$Category7->In_menu = 0;
        //$Category7->parent_id= 5;
        //$Category7->save();

       // $Category8 = new \App\Category();
        //$Category8->nom ="Bois d'olivier";
        ////$Category8->In_menu = 0;
        //$Category8->parent_id= 5;
        //$Category8->save();


        //$Category9 = new \App\Category();
       // $Category9->nom ="Bijoux";
        //$Category9->In_menu = 0;
       // $Category9->parent_id= 6;
        //$Category9->save();

        //$Category10 = new \App\Category();
       // $Category10->nom ="Sacs";
       // $Category10->In_menu = 0;
       // $Category10->parent_id= 6;
        //$Category10->save();
        $Category6 = new \App\Category();
        $Category6->nom ="Photographie";
        $Category6->In_menu = 0;
        $Category6->parent_id= 7;
        $Category6->save();

        $Category7 = new \App\Category();
        $Category7->nom ="Peinture";
        $Category7->In_menu = 0;
        $Category7->parent_id= 7;
        $Category7->save();

        $Category8 = new \App\Category();
        $Category8->nom ="Collage et techniques mixtes";
        $Category8->In_menu = 0;
        $Category8->parent_id= 7;
        $Category8->save();

        $Category9 = new \App\Category();
        $Category9->nom ="Sculpture";
        $Category9->In_menu = 0;
        $Category9->parent_id= 7;
        $Category9->save();

        $Category10 = new \App\Category();
        $Category10->nom ="Art textile";
        $Category10->In_menu = 0;
        $Category10->parent_id= 7;
        $Category10->save();

        $Category11 = new \App\Category();
        $Category11->nom ="Huiles essentielles";
        $Category11->In_menu = 0;
        $Category11->parent_id= 8;
        $Category11->save();

        $Category12 = new \App\Category();
        $Category12->nom ="Produits cosmétiques";
        $Category12->In_menu = 0;
        $Category12->parent_id= 8;
        $Category12->save();
    }
}
