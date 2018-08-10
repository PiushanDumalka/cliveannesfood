<?php

class District_model extends CI_Model {

    /** get city data */
    public function get_district() {
        $query = $this->db->get("district");
        return $query;
    }

    /** get district data for selected province */
    public function get_selected_district($province_id) {
        $this->db->select('*');
        $this->db->from('district');
        $this->db->where('province_id', $province_id);
        $query = $this->db->get();
        return $query;
    }

}
