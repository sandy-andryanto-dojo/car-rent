<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;


class ProductController extends BaseController{

    public function getProduct(Request $request){
        $data = array();
        $products = Car::where("cars.is_rent", 0);

        if($request->get("model_id")){
            $products->where("model_id", $request->get("model_id"));
        }

        if($request->get("brand_id")){
            $products->where("brand_id", $request->get("brand_id"));
        }

        if($request->get("type_id")){
            $products->where("type_id", $request->get("type_id"));
        }

        if($request->get("keyword")){
            $word = $request->get("keyword");
            if(strlen($word) > 0){
                $products->where(function($q) use ($word) {
                    $q->Where("id_number", 'like', '%' . $word . '%');
                });
            }
        }

        $response = $products->get();

        $index = 4; // col-md-3 => 12 : 3 
        $max = count($response) > $index ? round(count($response) / $index) : count($response);

        $start = 0;
        $end = $index;

        for($i = 0; $i < $max; $i++){
            $html = '<div class="row">';

            for($j = $start; $j < $end; $j++){
                $row = $response;
                if(isset($row[$j]->id)){

                    $image = url("assets/dist/img/no-image.png");
                    $imagePrimary = CarImage::where("car_id", $row[$j]->id)->where("is_primary", 1)->first();
                    $imageOrder = CarImage::where("car_id", $row[$j]->id)->inRandomOrder()->first();

                    if(!is_null($imagePrimary)){
                        $image = url($imagePrimary->path);
                    }

                    if(is_null($imagePrimary) && !is_null($imageOrder)){
                        $image = url($imageOrder->path);
                    }

                    $icon = "<i class='fa fa-edit'></i>";
                    $html .= '
                        <a href="javascript:void(0);" class="product-item" data-product="'.base64_encode(json_encode($row[$j])).'">
                            <div class="col-md-3">
                                <div class="product-bond" data-toggle="tooltip" data-placement="bottom" data-html="true"  data-original-title="'.$icon.'&nbsp;Add to invoice">
                                    <div class="text-center">
                                        <img src="'.$image.'" class="img-responsive img-thumbnail">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <p></p>
                                        <div class="col-md-12 text-center">
                                            <p class="product-name">ID : '.$row[$j]->id_number.'</p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 text-center">
                                            <span>Price</span>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <span>'.$row[$j]->charge.'</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 text-center">
                                            <span>Capacity</span>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <span>'.$row[$j]->capacity.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    ';
    
                }
            }

            $html .= '</div>';
            $html .= '<p></p>';
            $data[] = $html;

            $start += $index;
            $end += $index;
           
        }
        return response()->json($data);
    }

}