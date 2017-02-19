<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class homePhysician_model extends CI_Model {

    public function getPatients($userId) {
        $this->db->select('ID, Firstname, Lastname, Email, product_pic');
        $this->db->from('user');
        $this->db->where('PhysicianId', $userId);
        $this->db->order_by('ID');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getThresholdsPatient($patientId) {
        $this->db->select('painDown, painUp, weightDown, weightUp, pulseDown, pulseUp, sysDown, sysUp, diaDown, diaUp');
        $this->db->from('thresholds');
        $this->db->where('patientId', $patientId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getPatientsFromEmergency($physicianId) {
        $this->db->select('patientId, physicianId, firstName, lastName, pain, weight, pulse, blood');
        $this->db->from('emergency');
        $this->db->where('physicianId', $physicianId);
        $this->db->order_by('lastName');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getPatientFromEmergency($patientId) {
        $this->db->select('firstName, lastName');
        $this->db->from('emergency');
        $this->db->where('patientId', $patientId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function insertPatientAllert($data) {
        $this->db->insert('emergency', $data);
    }
    
    public function updatePatientAllert($patientId, $data){
        $this->db->where('patientId', $patientId);
        $this->db->update('emergency', $data);
    }
    
    public function deletePatientAllert($patientId) {
        $sql = 'DELETE FROM emergency WHERE patientId = ?';
        $this->db->query($sql, $patientId);
    }
    
    public function getNamePhysician($physicianId){
        $this->db->select('Firstname');
        $this->db->from('user');
        $this->db->where('ID', $physicianId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getType($userId) {
        $this->db->select('Usertype, PhysicianId');
        $this->db->from('user');
        $this->db->where('ID', $userId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
