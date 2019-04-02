<?php

namespace App\Controllers;

Class Posts
{
    /*
     * Show index page
     * @return void
     */
    public function index()
    {
        echo "Hello from the index action in the Posts controller";
    }

    /*
     * Show the add new page
     *
     * @return void
     */
    public function addNew()
    {
        echo "Hello from the index action in the Posts controller(method addNew())";
    }
}