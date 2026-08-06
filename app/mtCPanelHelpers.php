<?php

if (! function_exists('mtGetRoute')) {
    function mtGetRoute($type = null, $page = null, $id = null, $parent_id = null)
    {
        if($type == null && $type == '')    { $page .= ''; }
        if($type == 'index')    { $page .= '.index'; }
        if($type == 'create')   { $page .= '.create'; }
        if($type == 'edit')     { $page .= '.edit'; }
        if($type == 'store')    { $page .= '.store'; }
        if($type == 'update')   { $page .= '.update'; }
        if($type == 'show')     { $page .= '.show'; }
        if($type == 'destroy')  { $page .= '.destroy'; }
        
        if(isset($id) && !isset($parent_id)) { 
            $route = route( $page, ['id' => $id] ); 
        }
        if(!isset($id) && isset($parent_id)) { 
            $route = route( $page, ['parent_id' => $parent_id] ); 
        }
        if(isset($id) && isset($parent_id)) { 
            $route = route( $page, ['id' => $id, 'parent_id' => $parent_id] ); 
        }
        if(!isset($id) && !isset($parent_id)) { 
            $route = route($page); 
        }
        
        return $route; 
    }
}