<?php


namespace Core;


class View
{

    /**
     * Render a view file
     * @param string $view The view file
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; // Relative to core directory

        if (is_readable($file)) {
            require $file;
        } else {
            echo "File $file not found";
        }
    }
}