<?php

namespace App\Controllers;

Class Posts extends \Core\Controller
{
    /*
     * Show index page
     * @return void
     */
    public function indexAction()
    {
        echo "Hello from the index action in the Posts controller";
//        echo "<p>Query string parameters: <pre>".
//            htmlspecialchars(print_r($_GET, true)) . "</pre></p>";
    }

    /*
     * Show the add new page
     *
     * @return void
     */
    public function addNewAction()
    {
        echo "Hello from the index action in the Posts controller(method addNew())";
    }

    public function editAction()
    {
        echo "Hello from the edit action in the Posts controller!";
        echo "<p>Route parameters: <pre>" .
            htmlspecialchars(print_r($this->route_params, true)) . "</pre></p>";
    }
}