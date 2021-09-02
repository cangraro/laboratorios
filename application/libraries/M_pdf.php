<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_pdf {

    function pdf() {
        $CI = & get_instance();
        //log_message('Debug', 'mPDF class is loaded.');
    }

    function load($params = NULL) {
        include_once APPPATH . '/third_party/MPDF/mpdf.php';

        switch ($params) {
            case 'hoja_de_vida':
                return new mPDF("utf-8", "Letter", "", "", 4, 4, 4, 4, 0, 0, 'P');
                break;
            default:
                return new mPDF("utf-8", array(210, 279), "", "", 8, 8, 12, 8, 6, 3);
                break;
        }
    }

    /*
     * TODO:VIAFIRMA
     */

    function configuration($params) {

        if (empty($params)) {
            return array("utf-8", array(210, 279), "", "", 8, 8, 12, 8, 6, 3);
        } else {
            $params = explode(",", $params);
            return array("utf-8", "Letter", "", "", $params[0], $params[1], $params[2], $params[3], $params[4], $params[5], 'P');
        }
    }

}
