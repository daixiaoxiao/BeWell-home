<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu_model
 *
 */
class Physician_menu_model extends CI_Model {

    private $menu_items;

    function __construct() {
        parent::__construct();

        $this->menu_items = array(
            array('name' => 'Home', 'title' => 'Home', 'link' => 'homePhysician', 'className' => 'active'),
            array('name' => 'Patients', 'title' => 'Get a list of all the patients', 'link' => 'patientsPhysician', 'className' => 'inactive'),
            array('name' => 'Data', 'title' => 'Check the data of all the patients', 'link' => 'dataPhysician', 'className' => 'inactive'),
            array('name' => 'Manage', 'title' => 'Add new patients or staff workers', 'link' => 'managePhysician', 'className' => 'inactive'),
            //array('name' => 'Profile', 'title' => '...', 'link' => 'profilePhysician', 'className' => 'inactive'),
            array('name' => 'Survey', 'title' => 'Send questions to specific patients', 'link' => 'surveyPhysician', 'className' => 'inactive'),
            //array('name' => 'Logout', 'title' => '...', 'link' => 'logout', 'className' => 'inactive'),
        );
        $this->menu_items_logout = array(
            array('name' => 'Logout', 'title' => 'Logout', 'link' => 'logout')
            );
        
        $this->menu_items_profile = array(
            array('name' => 'Profile', 'title' => 'Check or change your profile', 'link' => 'profilePhysician')
            );
    }

    function set_active($menutitle) {
        foreach ($this->menu_items as &$item) {
            if (strcasecmp($menutitle, $item['name']) == 0) {
                $item['className'] = 'active';
            } else {
                $item['className'] = 'inactive';
            }
        }
    }
    
    function set_active_profile($menutitle) {
        foreach ($this->menu_items_profile as &$item) {
            if (strcasecmp($menutitle, $item['name']) == 0) {
                $item['className'] = 'active';
            } else {
                $item['className'] = 'inactive';
            }
        }
    }

    function get_menuitems($menutitle = 'Home') {
        $this->set_active($menutitle);
        return $this->menu_items;
    }

    function get_menuitems_logout($menutitle = 'logout') {
        $this->set_active($menutitle);
        return $this->menu_items_logout;
    }
    
    function get_menuitems_profile($menutitle = 'profile') {
        $this->set_active_profile($menutitle);
        return $this->menu_items_profile;
    }
}
