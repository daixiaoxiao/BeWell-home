<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class data_model extends CI_Model {

    public function getBloodpressureinfo($patientId) {
        $sql = 'SELECT DATE_FORMAT(FROM_UNIXTIME(`timestamp`), \'"%b %d"\') as date, pressureDiastolic, pressureSystolic FROM a15_web04.blood_pressure WHERE patientId = ? ORDER BY timestamp LIMIT 8';
        $q=$this->db->query($sql, $patientId);  
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getLatestBlood($patientId) {
        $sql = 'SELECT id, pressureDiastolic, pressureSystolic, timestamp FROM a15_web04.blood_pressure WHERE patientId = '.$patientId.' ORDER BY timestamp DESC LIMIT 1;';
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getLatestPulse($patientId) {
        $sql = 'SELECT id, pulse, timestamp FROM a15_web04.blood_pressure WHERE patientId = '.$patientId.' ORDER BY timestamp DESC LIMIT 1;';
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getBloodpressureTime($patientId) {
        $this->db->select('id, patientId, timestamp');
        $this->db->from('blood_pressure');
        $this->db->where('patientId', $patientId);
        $this->db->limit(8);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getWeightinfo($patientId) {
        $sql = 'SELECT DATE_FORMAT(FROM_UNIXTIME(`timestamp`), \'"%b %d"\') as date, weight FROM a15_web04.scale WHERE patientId = ? ORDER BY timestamp LIMIT 8';
        $q=$this->db->query($sql, $patientId);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getLatestWeight($patientId) {
        $sql = 'SELECT id, weight, timestamp FROM a15_web04.scale WHERE patientId = '.$patientId.' ORDER BY timestamp DESC LIMIT 1;';
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getWeightTime($patientId) {
        $this->db->select('id, patientId, timestamp');
        $this->db->from('scale');
        $this->db->where('patientId', $patientId);
        $this->db->limit(8);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getPaininfo($patientId) {
        $sql = 'SELECT DATE_FORMAT(FROM_UNIXTIME(`timestamp`), \'"%b %d"\') as date, painLevel FROM a15_web04.pain_diary WHERE patientId = ? ORDER BY timestamp LIMIT 8';
        $q=$this->db->query($sql, $patientId);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getLatestPain($patientId) {
        $sql = 'SELECT id, painLevel, timestamp FROM a15_web04.pain_diary WHERE patientId = '.$patientId.' ORDER BY timestamp DESC LIMIT 1;';
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getPaininfoDate($patientId, $time) {
        $lastweek = $time - 604800;
        $sql = 'SELECT DATE_FORMAT(FROM_UNIXTIME(`timestamp`), \'"%b %d"\') as date, painLevel FROM a15_web04.pain_diary WHERE patientId = '.$patientId.' AND '.$lastweek.' < timestamp AND timestamp < '.$time.' ORDER BY timestamp;';
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                    $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getPaininfoUnix($patientId, $time) {
        $lastweek = $time - 604800;
        $sql = 'SELECT timestamp, painLevel FROM a15_web04.pain_diary WHERE patientId = '.$patientId.' AND '.$lastweek.' < timestamp AND timestamp < '.$time.' ORDER BY timestamp;';
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                    $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getHistoryPain($patientId, $time){
        $lastweek = $time - 604800;
        $sql = 'SELECT DATE_FORMAT(FROM_UNIXTIME(`timestamp`), \'"%b %d"\') as date, painLevel, remark FROM a15_web04.pain_diary WHERE patientId = '.$patientId.' AND '.$lastweek.' < timestamp AND timestamp < '.$time.' ORDER BY timestamp DESC;';
        $q=$this->db->query($sql);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                    $data[] = $row;
            }
            return $data;
        }
    }

    public function getActivityinfo($patientId) {
        $this->db->select('date, steps, calories, distance');
        $this->db->from('pulse_activity');
        $this->db->where('patientId', $patientId);
        $this->db->where('steps !=', 0);
        $this->db->order_by('date');
        $this->db->limit(3);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getOxygeninfo($patientId) {
        $sql = 'SELECT DATE_FORMAT(FROM_UNIXTIME(`timestamp`), \'"%b %d"\') as date, oxygenSaturation FROM a15_web04.pulse_oxygen WHERE patientId = ? ORDER BY timestamp';
        $q=  $this->db->query($sql, $patientId);
        if($q->num_rows() > 0) {
            foreach ($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getOxygenTime($patientId) {
        $this->db->select('id, patientId, timestamp');
        $this->db->from('pulse_oxygen');
        $this->db->where('patientId', $patientId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getName($patientId) {
        $this->db->select('Firstname, Lastname');
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
    
    public function getInfo($id){
        $this->db->select('Firstname, Lastname, Gender, Height, Email, Password, Birthday, product_pic');
        $this->db->from('user');
        $this->db->where('ID', $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } 
    }
    
    public function insertPatient($data){
        $this->db->insert('user', $data);
        $patientId = $this->db->insert_id();
        return $patientId;
    }
    
    public function insertPerson($patientId, $data) {
        $person = array(
            'id' => $patientId,
            'name' => $data['Lastname'],
            'firstname' => $data['Firstname']
        );
        $this->db->insert('person', $person);
    }
    
    public function getTasks($patientId){
        $this->db->select('idTask, idPatient, task, time, done, link, button');
        $this->db->from('tasks');
        $this->db->where('idPatient', $patientId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function insertTasks($data){
        $this->db->insert('tasks', $data);
    }
    
    public function makeTasks($patientId){
        $data1 = array(
            'idPatient' => $patientId,
            'task' => 'Fill in pain diary',
            'time' => time(),
            'done' => '0',
            'link' => 'painPatient',
            'button' => 'Go to'
        );
        $data2 = array(
            'idPatient' => $patientId,
            'task' => 'Do survey',
            'time' => time(),
            'done' => '0',
            'link' => 'surveyPatient',
            'button' => 'Go to'
        );
        $data3 = array(
            'idPatient' => $patientId,
            'task' => 'Take blood pressure',
            'time' => time(),
            'done' => '0',
            'link' => 'measurementBlood',
            'button' => 'Manual'
        );
        $data4 = array(
            'idPatient' => $patientId,
            'task' => 'Take oxygen measurement',
            'time' => time(),
            'done' => '0',
            'link' => 'measurementOxygen',
            'button' => 'Manual'
        );
        $data5 = array(
            'idPatient' => $patientId,
            'task' => 'Take weight measurement',
            'time' => time(),
            'done' => '0',
            'link' => 'measurementWeight',
            'button' => 'Manual'
        );
        $data6 = array(
            'idPatient' => $patientId,
            'task' => 'Sleep with sleep strip',
            'time' => time(),
            'done' => '0',
            'link' => 'measurementSleep',
            'button' => 'Manual'
        );
        $this->db->insert('tasks', $data1);
        $this->db->insert('tasks', $data2);
        $this->db->insert('tasks', $data3);
        $this->db->insert('tasks', $data4);
        $this->db->insert('tasks', $data5);
        $this->db->insert('tasks', $data6);
    }
    
    public function updateTask($idTask, $done){
        $this->db->where('idTask', $idTask);
        $dataArray = array(
            'time' => time(),
            'done' => $done
        );
        $this->db->update('tasks', $dataArray);
    }
    
    public function updateTaskWithId($patientId, $task, $done) {
        $this->db->where('idPatient', $patientId);
        $this->db->where('task', $task);
        $dataArray = array(
            'time' => time(),
            'done' => $done
        );
        $this->db->update('tasks', $dataArray);
    }
    
    public function updateTaskWithLink($patientId, $link) {
        $this->db->where('idPatient', $patientId);
        $this->db->where('link', $link);
        $dataArray = array(
            'time' => time(),
            'done' => '1'
        );
        $this->db->update('tasks', $dataArray);
    }
    
    public function getTask($idTask){
        $this->db->select('task');
        $this->db->from('tasks');
        $this->db->where('idTask', $idTask);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function insertPain($data){
        $this->db->insert('pain_diary', $data);
    }
    
    
    public function updateProfile($userId, $data)
    {
        $this->db->where('ID', $userId);
        $this->db->update('user', $data);
    }
    
    public function insert_file($filename, $id){   //only add profile image for existing patients 

        $this->db->where('ID', $id);
        $data = array (
            'product_pic' => $filename
                 
        );
        //$this->db->insert('imagefile',$data);
        //$this->db->insert('user',$data);
        $this->db->update('user',$data);
      //  return $this->db->insert_id();
        return 1;
    }
    /*
     * Physician
     */
    
    
    public function getPhysicianProfile($userId){
        $this->db->select('Firstname, Lastname, Gender, Height, Email, Password, Birthday, product_pic');
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
    
    public function getPhysicianIdOfPatient($userId){
        $this->db->select('PhysicianId');
        $this->db->from('user');
        $this->db->where('ID', $userId);
        $q = $this->db->get();
        
        $my_values = array();
        if ($q->num_rows() > 0) {
            foreach($q->result() as $row)
            {
                $my_values[] = $row->PhysicianId;
            }
        }
        return $my_values[0];
    }


    public function getPhysicianAssistants($userId){
        $this->db->select('ID, Username, Firstname, Lastname, Email, product_pic');
        $this->db->from('user');
        $this->db->where('PhysicianId', $userId);
        $this->db->where('Usertype', '3');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getMessages($patientId) {
        $this->db->select('id,title, message');
        $this->db->from('message');
        $this->db->where('patientId', $patientId);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function insertThresholds($data) {
        $this->db->insert('thresholds', $data);
    }
    
    public function getThresholds($idPatient){
        $this->db->select('painDown, painUp, weightDown, weightUp, pulseDown, pulseUp, sysDown, sysUp,diaDown, diaUp, oxygenDown, oxygenUp');
        $this->db->from('thresholds');
        $this->db->where('patientId', $idPatient);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function updateThresholds($idPatient, $data) {
        $this->db->where('patientId', $idPatient);
        $this->db->update('thresholds', $data);
    }
    
    public function insertMessage($data) {
        $this->db->insert('message', $data);
    }
    
    public function deleteMessage($data) {
        $this->db->where('id', $data);
        $this->db->delete('message');
    }
    
    public function deletePatient($data) {
        $this->db->where('ID', $data);
        $this->db->delete('user');
    }
    
    public function getPicture($patientId) {
        $this->db->select('Firstname, product_pic');
        $this->db->from('user');
        $this->db->where('ID', $patientId);
        $this->db->limit(1);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function deleteAssistantOfAPhysician($assistantId) {
        $data = array(
               'physicianId' => '0',
            );

        $this->db->where('ID', $assistantId);
        $this->db->update('user', $data); 
    }
}

