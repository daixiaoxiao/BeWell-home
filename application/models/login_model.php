<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class login_model extends CI_Model {

    public function getPassword($userName) {
        $this->db->select('Password, Usertype, ID, Firstname, TempPassword');
        $this->db->from('user');
        $this->db->where('Username', $userName);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return NULL;
        }
    }
    
    public function getDataFromEmail($email) {
        $this->db->select('ID, Firstname');
        $this->db->from('user');
        $this->db->where('Email', $email);
        $this->db->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return NULL;
        }
    }
    
    public function fillTempPassword($id, $password){
        $this->db->where('ID', $id);
        $dataArray = array(
            'TempPassword' => $password
        );
        $this->db->update('user', $dataArray);
    }
    
    public function changePassword($id, $password) {
        $this->db->where('ID', $id);
        $dataArray = array(
            'Password' => $password,
            'TempPassword' => NULL
        );
        $this->db->update('user', $dataArray);
    }
    
    public function getPasswordFromId($id) {
        $this->db->select('Password');
        $this->db->from('user');
        $this->db->where('ID', $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return NULL;
        }
    }

}
