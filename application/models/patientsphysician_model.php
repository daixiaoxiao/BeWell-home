<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of patientsPhysician_model
 *
 * @author dai
 */
class patientsPhysician_model extends CI_Model {

    public function getPatients($physicianId) {
        $this->db->select('*');
        $this->db->from('user');
        //$this->db->where('Usertype', 2);
        $this->db->where('PhysicianId', $physicianId);
        $this->db->order_by('Lastname');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
