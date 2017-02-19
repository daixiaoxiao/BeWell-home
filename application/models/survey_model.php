<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class survey_model extends CI_Model {

    public function getQuestion($patientId) {
        $this->db->select('idQuestion, question, option1, option2, option3');
        $this->db->from('survey');
        $this->db->where('patientId', $patientId);
        $this->db->order_by('question');
        //$this->db->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        //echo $data;
    }

    public function insertQuestion($data) {
        $this->db->insert('survey', $data);
    }

    public function updateQuestion($id, $data) {
        $this->db->where('idQuestion', $id);
        $this->db->update('survey', $data);
    }

    public function insertAnswer($id, $data) {
        $this->db->insert('survey_answers', $data);
        
        $this->db->where('idQuestion', $id);
        $this->db->delete('survey');
    }
}
