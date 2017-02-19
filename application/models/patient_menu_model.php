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
class Patient_menu_model extends CI_Model {

    private $menu_items;
    private $sec_menu_items;

    function __construct() {
        parent::__construct();
        $this->menu_items = array(
            array('name' => 'Home', 'title' => 'Home', 'link' => 'homePatient'),
            array('name' => 'Measurements', 'title' => 'Do measurements or see your data', 'link' => 'dataPatient'),
            array('name' => 'Pain Diary', 'title' => 'Fill in your Pain diary or watch your history', 'link' => 'painPatient'),
            array('name' => 'Survey', 'title' => 'Answer the questions of your physician', 'link' => 'surveyPatient'),
        );
                
        $this->menu_items_logout = array(
            array('name' => 'Logout', 'title' => 'Logout', 'link' => 'logout')
            );
        
        $this->menu_items_profile = array(
            array('name' => 'Profile', 'title' => 'Profile', 'link' => 'profilePatient')
            );
        
        $userId = $this->session->userdata('userId');
          $sql = 'SELECT count(id) FROM a15_web04.message WHERE patientId = ?';
        $q=  $this->db->query($sql, $userId);
        if($q->num_rows() > 0) {
            foreach ($q->row() as $row){
                $data[] = $row;
                $number = $data[0];
            }
        }

        $this->menu_items_message = array(
            array('name' => 'Message', 'title' => 'Message', 'link' => 'messagePatient', 'number' => $number)
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
    
        function get_menuitems_message($menutitle = 'Message') {
        $this->set_active($menutitle);
        return $this->menu_items_message;
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
