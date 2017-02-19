<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class dataPhysician_model extends CI_Model {
    
        public function getBloodpressureData($id, $nrData) {
        $this->db->select('patientId, pressureSystolic, pressureDiastolic');
        $this->db->from('blood_pressure');     
        $this->db->where('patientId',$id); 
        $this->db->limit($nrData);
        
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {

                    $data[] = $row;
            
            }
            return $data;
        }
    }
    
        public function getWeightData($id, $nrData) {
        $this->db->select('patientId, weight');
        $this->db->from('scale');     
        $this->db->where('patientId',$id); 
        $this->db->limit($nrData);
        
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {

                    $data[] = $row;
            
            }
            return $data;
        }
    }
    
        public function getPainData($id, $nrData) {
        $this->db->select('patientId, painLevel');
        $this->db->from('pain_diary');     
            $this->db->where('patientId',$id); 
        $this->db->limit($nrData); 
        
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {

                    $data[] = $row;
            
            }
            return $data;
        }
    }
    
        public function getActivityData($id, $nrData) {
        $this->db->select('patientId, steps, calories, distance');
        $this->db->from('pulse_activity');     
            $this->db->where('patientId',$id); 
        $this->db->limit($nrData); 
        
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {

                    $data[] = $row;
            
            }
            return $data;
        }
    }
    
    
        public function getOxygenData($id, $nrData) {
        $this->db->select('patientId, oxygenSaturation');
        $this->db->from('pulse_oxygen');     
            $this->db->where('patientId',$id); 
        $this->db->limit($nrData); 
        
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {

                    $data[] = $row;
            
            }
            return $data;
        }
    }
    

}