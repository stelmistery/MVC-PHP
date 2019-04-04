<?php


namespace App\Controllers\Admin;

/*
 * User admin controller
 * PHP 7.2
 */

class Users extends \Core\Controller
{
    /*
     * Before filter
     * @return void
     */
    protected function before()
    {

    }

    /*
     * SHow the index page
     */
    public function indexAction()
    {
        echo "User admin page";
    }
}