<?php

class City_model extends CI_Model {

    /**get city data*/
    public function get_city() {
        $query = $this->db->get("city");
        return $query;
    }
   /** get city data for selected province */

    public function get_selected_city($district_id) {
        $this->db->select('*');
        $this->db->from('city');
        $this->db->where('district_id', $district_id);
        $query = $this->db->get();
        return $query;
    }
}
