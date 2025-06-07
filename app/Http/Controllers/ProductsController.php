<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function createProduct(Request $req){
        // return $req;
        if ($req->productName && $req->productDesc && $req->productPrice && $req->productImage){
            return 'Working';
        } else if ($req->productName && $req->productPrice && $req->productImage){
            return 'Also Working';
        } else if ($req->productName && $req->productDesc && $req->productPrice){
            return 'Definitely Working';
        } else if ($req->productName && $req->productPrice){
            return 'Insanely Working';
        } else {
            return 'Please enter both a product name and price.';
        }
    }
}
