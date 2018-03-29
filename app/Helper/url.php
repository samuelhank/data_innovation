<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/2/18
 * Time: 3:54 PM
 */
function current_page($uri= "/"){
    return strstr(request()->path(), $uri);
}