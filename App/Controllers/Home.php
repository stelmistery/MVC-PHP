<?php


namespace App\Controllers;
use \Core\View;

class Home extends \Core\Controller
{
    /*
     * before filter
     * return void
     */
    protected function before()
    {
//        echo "(before) ";
        //return false;
    }

    /*
     * after filter
     * return void
     */
    protected function after()
    {
//        echo "(after) ";
    }

    /*
     * Show the index page
     * $return void
     */
    public function indexAction()
    {
//        echo "Hello from the action in the Home controller!";
/*        View::render('Home/index.php', [
            'name' => 'Dave',
            'colours' => ['red','green','blue']
        ]);*/

        View::renderTemplate('Home/index.html',[
            'name' => 'Dave',
            'colours' => ['red','green', 'blue']
        ]);
    }
}