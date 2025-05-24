<?php 
namespace Mewebdev\Wpmenu;

class MeWebDev_WPMenuItems
{
    protected $menuItems;

    function __construct($theme_location, $get_menu_locations_function, $get_menu_items_function, $get_term_function)
    {
        if ( ($theme_location) && ($locations = $get_menu_locations_function()) && isset($locations[$theme_location]) ) 
        {
            $menu = $get_term_function( $locations[$theme_location], 'nav_menu' );
            $this->menuItems = $get_menu_items_function($menu->term_id);
        }
    }

    protected function has_children($menu_items, $object_id) 
    {
        $has_children = false;
        
        foreach($menu_items as $obj)
        {
            if (!empty($obj->menu_item_parent))
            {
                if($obj->menu_item_parent == $object_id)
                {
                    $has_children = true;
                    break;
                }
            }
            
        }
        
        return $has_children;
    }
}