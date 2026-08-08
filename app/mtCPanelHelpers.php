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
        
        $values = [];
        if (isset($id)) {
            $values[] = $id;
        }
        if (isset($parent_id)) {
            $values[] = $parent_id;
        }

        // Resource routes use meaningful placeholders such as {college} and
        // {staff}; the legacy helper always sent {id}/{parent_id}, which Laravel
        // treated as query values and could generate broken nested URLs.
        $routeDefinition = app('router')->getRoutes()->getByName($page);
        if (!$routeDefinition || empty($values)) {
            return route($page);
        }

        return route($page, array_combine(
            array_slice($routeDefinition->parameterNames(), 0, count($values)),
            $values
        ));
    }
}
