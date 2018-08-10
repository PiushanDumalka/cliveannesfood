<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model("pdf");

        // $this->load->library('form_validation');
    }

    public function index() {
        $data['page'] = 'export-pdf';
        $data['title'] = 'Export PDF data | Web Preparations';
        $data['mobiledata'] = $this->pdf->mobileList();
        // load view file for output
        $this->load->view('header');
        $this->load->view('pdf/pdf', $data);
        $this->load->view('footer');
    }

    public function save_pdf() {
        // boost the memory limit if it's low ;)
        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        // retrieve data from model or just static date
        $data['title'] = "items";
        $pdf->allow_charset_conversion = true;  // Set by default to TRUE
        $pdf->charset_in = 'UTF-8';
        //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('system/pdf/pdf', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'itemreport' . date('Y_m_d_H_i_s') . '_.pdf';
        $pdf->Output("$output", 'I');
        // save to file because we can exit();
    }

// for generate pdf
    public function save_pdf_old() {
        //load mPDF library
        $this->load->library('m_pdf');
        //now pass the data//
        $data['get_users'] = $this->pdf->get_users();
        $html = $this->load->view('system/pdf/pdf', $data, true); //load the pdf.php by passing our data and get all data in $html varriable.
        $pdfFilePath = "webpreparations-" . time() . ".pdf";
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load(); //generate the PDF!
        $stylesheet = '<style>' . file_get_contents('assets/pdf/css/bootstrap.min.css') . '</style>'; // apply external css
        $stylesheets = '<style>' . file_get_contents('assets/pdf/css/style.css') . '</style>'; // apply external css

        $pdf->WriteHTML($stylesheet, 1);
        $pdf->WriteHTML($stylesheets, 1);
        $pdf->WriteHTML($html, 2);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
        exit;
    }

}
