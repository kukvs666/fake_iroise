<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListProducts;
use App\Packing;

class mjmlController extends Controller
{
    //
    /* $mjml = '/home/vagrant/code/essai/node_modules/.bin/mjml';

    $mjmlComplet = view('mjml/test', [
        'produit' => 'Araignée de mer cuite base 1.2 kg : ',
        'prix' => '15 € pièce',
        'accroche' => '"On entre dans la pleine saison ! "']);

    file_put_contents('temp.mjml', $mjmlComplet);
    shell_exec($mjml . ' temp.mjml -o sortie.html');
    return shell_exec('cat sortie.html');
}); */

    public function getForm ()
    {
        //Get data from sell_unit table
        //Add sell_unit key to $tableau variable.
        $tableau = [];
        $tableau["sell_unit"] = [];

        $data = \App\Sell_unit::all();
        $index = 0;
        foreach ($data as $value) {
            $T_sell_unit = [
              "id" => $value->id,
              "unit" => $value->unit,
              "active" => false
          ];
            $tableau["sell_unit"][(string)$index] = $T_sell_unit;
            $index++;
        }

        //Add price key to $tableau variable.
        $tableau["price"] = 0;


        //Get data from calibre table
        //Add calibre key to $tableau variable.
        $gabarits = \App\Gabarit::all();
        $tableau["calibre"] = [];
        $index = 0;
        foreach ($gabarits as $value) {
            $T_gabarit = [
              "id" => $value->id,
              "active" => false,
              "template" => $value->template_gabarit,
              "type_id" => $value->type_id,
              "type" => $value->type,
              "min" => 0,
              "max" => 0,
              "base" => 0,
              "desc-calibre" => ''
            ];
            $tableau["calibre"][(string)$index] = $T_gabarit;
            $index++;
        }

        //Get data from teaser table
        //Add teaser key to $tableau variable.
        $tableau["teaser"] = [];
        $teaser = \App\Teaser::all();
        $index = 0;
        foreach ($teaser as $value) {
            $T_teaser = [
                "id" => $value->id,
                "active" => false,
                "content" => $value->content
            ];
            $tableau["teaser"][(string)$index] = $T_teaser;
            $index++;
        }

        //Get data from products table
        //Add products key to $tableau variable.
        $tableau["products"] = [];
        $products = \App\Product::all();
        $index = 0;
        foreach ($products as $value) {
            $T_product = [
                "id" => $value->id,
                "active" => false,
                "nameProduct" => $value->nom
            ];
            $tableau["products"][(string)$index] = $T_product;
            $index++;
        }

        $envoi = json_encode($tableau);
        return view('mjml/setForm', ['data' => $envoi]);
    }


    public function postForm (Request $request)
    {
      $data = $request->all();
      foreach ($data as $value) {
        $listProducts = new ListProducts;
        $listProducts->products_id = $value['product']['id'];
        $listProducts->teaser_id = $value['teaser']['id'];
        $listProducts->save();

        $id = \App\ListProducts::latest()->first()->id;
        foreach ($value['packings'] as $pack) {
          $packing = new Packing;
          $packing->sell_unit_id = $pack['sell_unit']['id'];
          $packing->list_product_id = $id;
          $packing->price = $pack['price'];
          $packing->format = $pack['format'];

          if ($pack['calibre']['type_id'] <= 2) {
            $packing->min = $pack['calibre']['min'];
            $packing->max = $pack['calibre']['max'];
            $packing->base = null;
            $packing->desc_calibre = null;
          } else if ($pack['calibre']['type_id'] <=4) {
            $packing->min = null;
            $packing->max = null;
            $packing->base = $pack['calibre']['base'];
            $packing->desc_calibre = null;
          } else if ($pack['calibre']['type_id'] > 4) {
            $packing->min = null;
            $packing->max = null;
            $packing->base = null;
            $packing->desc_calibre = $pack['calibre']['desc-calibre'];
          }
          dump($pack);
          $packing->save();

        }
      }
      //return response()->view('mjml/voir', ['data' => $request], 200)->header('Content-Type', 'text/html');
    }
}

