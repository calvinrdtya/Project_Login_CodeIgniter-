<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_menu extends CI_Model
{
  public function SemuaData()
  {
      return $this->db->get('user_sub_menu')->result_array();
  }
  public function proses_tambah_data()
  {
      $data = [
            "title"  => $this->input->post('title', true),
            "menu"   => $this->input->post('menu', true),
            "url"    => $this->input->post('url', true),
            "icon"   => $this->input->post('icon', true),
            "active" => $this->input->post('active', true),
      ];
      $this->db->insert('user_sub_menu', $data);
  }
  public function hapus_data($id)
  {
      $this->db->where('id', $id);
      $this->db->delete('user_sub_menu');
  }

}