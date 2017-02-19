<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class queryPatient_model extends CI_Model {
    
    public function getPatientsWhereQuery($table, $parameter1, $parameter2, $valueLesser, $valueGreater)
    {
    
        $sql = 'SELECT A.patientId FROM '.$table.' A LEFT JOIN '.$table.' B ON (A.patientId = B.patientId AND A.id < B.id) WHERE B.'.$parameter1.' IS NULL AND A.'.$parameter1.' <= '.$valueGreater.' AND A.'.$parameter2.' >= '.$valueLesser.';';
        
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getUser($patientId) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('ID', $patientId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    
    
}