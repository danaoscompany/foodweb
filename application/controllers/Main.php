<?php

class Main extends CI_Controller {
  
  public function execute() {
    $cmd = $this->input->post('cmd');
    $this->db->query($cmd);
    //echo json_encode($this->db->display_errors());
  }
  
  public function query() {
    $cmd = $this->input->post('cmd');
    echo json_encode($this->db->query($cmd)->result_array());
  }
  
  
  public function login() {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $users = $this->db->get_where('buyers', array(
      'email' => $email,
      'password' => $password
    ))->result_array();
    if (sizeof($users) > 0) {
      $user = $users->row_array();
      $user['role'] = 0;
      echo json_encode($user);
    } else {
      $sellers = $this->db->get_where('sellers', array(
      'email' => $email,
      'password' => $password
    ))->result_array();
      if (sizeof($sellers) > 0) {
        $seller = $sellers->row_array();
        $seller['role'] = 1;
        echo json_encode($seller);
      } else {
        $drivers = $this->db->get_where('drivers', array(
          'email' => $email,
          'password' => $password
        ))->result_array();
        if (sizeof($drivers) > 0) {
          $driver = $drivers->row_array();
          $driver['role'] = 2;
          echo json_encode($driver;
        } else {
          echo -1;
        }
      }
    }
  }
  
  public function signup() {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $role = intval($this->input->post('role'));
    if ($role == 0) {
      $buyers = $this->db->get_where('buyers', array(
        'email' => $email
      ))->result_array();
      if (sizeof($buyers) > 0) {
        echo -1;
      } else {
        $this->db->insert('buyers', array(
          'email' => $email,
          'password' => $password
        ));
      }
    } else if ($role == 0) {
      $sellers = $this->db->get_where('sellers', array(
        'email' => $email
      ))->result_array();
      if (sizeof($sellers) > 0) {
        echo -1;
      } else {
        $this->db->insert('sellers', array(
          'email' => $email,
          'password' => $password
        ));
      }
    } else if ($role == 2) {
      $drivers = $this->db->get_where('drivers', array(
        'email' => $email
      ))->result_array();
      if (sizeof($drivers) > 0) {
        echo -1;
      } else {
        $this->db->insert('drivers', array(
          'email' => $email,
          'password' => $password
        ));
      }
    }
  }
}