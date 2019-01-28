<?php
/**
 * Created by PhpStorm.
 * User: Noname
 * Date: 28.01.2019
 * Time: 12:43
 */

class Linker
{
    public function page($pageNumber){
        $query = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
        parse_str($query, $query);
        $query['page'] = $pageNumber;
        $query = '?'.http_build_query($query);
        return htmlspecialchars($query, ENT_QUOTES);
    }

    public function sort($column){
        $query = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
        parse_str($query, $query);
        if (array_key_exists( 'sort',$query)) {
            $query['sort'] = explode(',',$query['sort']);
            if(in_array($column,$query['sort'])){
                $query['sort'] = in_array('asc',$query['sort'])? $column . ',desc': $column.',asc';
            } else {
                $query['sort'] = $column . ',asc';
            }
        } else{
            $query['sort'] = $column.',asc';
        }
        $query = '?'.http_build_query($query);
        return htmlspecialchars($query, ENT_QUOTES);
    }

}