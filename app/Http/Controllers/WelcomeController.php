<?php
/**
 * Created by PhpStorm.
 * User: alyson
 * Date: 29/06/17
 * Time: 21:50
 */

namespace CookieSoftCommerce\Http\Controllers;


class WelcomeController extends Controller
{

    public function index(){
        return view("welcome");
    }

}