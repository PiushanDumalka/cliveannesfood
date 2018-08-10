<?php

class Product_model extends CI_Model {

    /** get product data */
    public function insert_productdetails($data_product) {
        $result = $this->db->insert("product", $data_product);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_products() {

        //get all products
        $this->db->select('t1.*,t2.Weight,t2.Unit,t3.CategoryName');
        $this->db->from('product t1');
        $this->db->join('productweight t2', 't1.WeightId = t2.Id', 'INNER');
        $this->db->join('productcategory t3', 't1.ProductCategory = t3.Id', 'INNER');
        $this->db->where('t1.Status', 1);
        $result = $this->db->get();
        return $result;
    }

    public function get_searched_products($search) {
        //get all product for matching searched
         $this->db->select('t1.*,t2.Weight,t2.Unit,t3.CategoryName');
        $this->db->from('product t1');
        $this->db->join('productweight t2', 't1.WeightId = t2.Id', 'INNER');
        $this->db->join('productcategory t3', 't1.ProductCategory = t3.Id', 'INNER');
        $this->db->like('t1.ProductName', $search);
        $this->db->where('t1.Status', 1);
      //  $this->db->limit(1);
        $result = $this->db->get('product');

        return $result->result();
    }

    public function get_product($id) {
        //get a single product details
        $this->db->select('t1.*,t2.Weight,t2.Unit,t3.CategoryName');
        $this->db->from('product t1');
        $this->db->join('productweight t2', 't1.WeightId = t2.Id', 'INNER');
        $this->db->join('productcategory t3', 't1.ProductCategory = t3.Id', 'INNER');
        //$this->db->where('t1.Status', 1);
        $this->db->where('t1.Id', $id);
        $result = $this->db->get();

        return $result;
    }

    public function get_price_history($id) {
        //get a single product price history details
        $this->db->select('*');
        $this->db->from('pricechangehistory');
        $this->db->where('ProductId', $id);
        $this->db->order_by('DateTime', 'ASC');
        $result = $this->db->get();

        return $result;
    }

    /** Edit product details */
    public function edit_productdetails($product_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('product', $product_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** get all deleted products * */
    public function get_outofstock_products() {

        //get all products
        $this->db->select('t1.*,t2.Weight,t2.Unit,t3.CategoryName');
        $this->db->from('product t1');
        $this->db->join('productweight t2', 't1.WeightId = t2.Id', 'INNER');
        $this->db->join('productcategory t3', 't1.ProductCategory = t3.Id', 'INNER');
        $this->db->where('t1.Status', 0);
        $result = $this->db->get();
        return $result;
    }

    /** Edit product details */
    public function edit_pricedetails($product_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('product', $product_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** add price history data */
    public function add_pricedetails($data_price_history) {
        $result = $this->db->insert("pricechangehistory", $data_price_history);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

}
