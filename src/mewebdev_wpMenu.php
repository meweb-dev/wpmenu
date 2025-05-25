<?php

namespace Mewebdev\Wpmenu;

class MeWebDev_WPMenu extends MeWebDev_WPMenuItems
{
    /**
     * @param $theme_location The menu location: i.e. 'Top-Menu'
     * @param $get_menu_locations_function The menu locations function i.e. 'get_menu_locations_function'
     * @param $get_menu_items_function The menu_items function i.e. 'get_menu_items_function'
     */
    function __construct($theme_location, $get_menu_locations_function, $get_menu_items_function, $get_term_function)
    {
        parent::__construct($theme_location, $get_menu_locations_function, $get_menu_items_function, $get_term_function);
    }

    public function getMenu()
    {
        if(is_array($this->menuItems) && count($this->menuItems) > 0) {

            $menu_list = '<ul>';
                    
                $menu_list .= $this->getMenuItems($this->menuItems);
    
            $menu_list .= '</ul>';
    
            return $menu_list;
        }

    }

    private function getMenuItems($menu_items)
    {  
        $hf1_menu = "";
        
        foreach($menu_items as $m)
        {
            if (empty($m->menu_item_parent))
            {
                $hf1_menu .= $this->create_menu($menu_items, $m);
            }
        }
        
        return $hf1_menu;
    }

    private function create_menu($menu_items, $object, $isDropDownItem = false) 
    {
        $hf_menu = "<li>";
        
        if($this->has_children($menu_items, $object->ID))
        {
            $hf_menu .= '<a href="'.$object->url.'">'.$object->title.'</a>';
            
            $hf_menu .= $this->create_sub_menu($menu_items, $object->ID);
        }
        else
        {
            $hf_menu .= "<a href=".$object->url.">".$object->title."</a>";   
        }
        
        $hf_menu .= "</li>";
        
        return $hf_menu;
    }

    private function create_sub_menu($menu_items, $object_id)
    {
        $hf_sub_menu = "<ul>";
        
        foreach($menu_items as $obj)
        {
            if (!empty($obj->menu_item_parent))
            {
                if($obj->menu_item_parent == $object_id)
                {
                    $hf_sub_menu .= $this->create_menu($menu_items, $obj, true);
                }
            }
        }
        
        $hf_sub_menu .= "</ul>";
        
        return $hf_sub_menu;
    }
}