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
}