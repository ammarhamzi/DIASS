<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelOutput extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
    }

    public function index()
    {
        echo 'Not Found.';
    }

    public function charge_collection()
    {
        $single_date_get = $this->input->get('single_date');
        $working_session = $this->input->get('shift');
        $payment_method_get = $this->input->get('payment_method');
        $payment_location = $this->input->get('payment_location');

        $list = $this->Payment_model->get_all_payment_permit($single_date_get, $payment_method_get, $payment_location);

        // printr($list);
        // die();

        /*----------  EXCEL PART  ----------*/
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        /*----------  HEADER  ----------*/
        $row = 1;
        $alpha = array(
            // "A".$row=>" Kod",
            // "B".$row=>" Jenis",
            "A" . $row => " Keterangan",
            "B" . $row => " Rujukan",
            "C" . $row => " Tarikh",
            "D" . $row => " Masa",
            "E" . $row => " Lokasi",
            "F" . $row => " Kaedah Pembayaran",
            "G" . $row => " Amaun (RM)",
        );
        foreach ($alpha as $key => $value) {
            $sheet->setCellValue($key, $value);
        }

        // make header bold
        $sheet->getStyle('A' . $row . ':G' . $row)->getFont()->setBold(true);

        // autosize column
        $colss = array('A', 'B', 'C', 'D', 'E', 'F', 'G');
        foreach ($colss as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $row_data = $row + 1;
        if (isset($list) && count($list) > 0) {
            foreach ($list as $field) {
                $lokasi = !empty($field->lokasi) ? $field->lokasi : 'KLIA';

                switch ($field->paymentMethod) {
                    case 1:
                        $payment_method_txt = 'Cash';
                        break;
                    case 2:
                        $payment_method_txt = 'Cheque';
                        break;
                    case 3:
                        $payment_method_txt = 'Credit / Debit Card';
                        break;
                    case 4:
                        $payment_method_txt = 'Free of Charge';
                        break;
                    default:
                        $payment_method_txt = 'None';
                        break;
                }

                // $sheet->setCellValue('A'.$row_data, $field->kod)
                //         ->setCellValue('B'.$row_data, $field->jenis)
                $sheet->setCellValue('A' . $row_data, $field->keterangan)
                    ->setCellValue('B' . $row_data, $field->rujukan)
                    ->setCellValue('C' . $row_data, date('d-m-Y', strtotime($field->paidDate)))
                    ->setCellValue('D' . $row_data, date('h:i A', strtotime($field->paidDate)))
                    ->setCellValue('E' . $row_data, $lokasi)
                    ->setCellValue('F' . $row_data, $payment_method_txt)
                    ->setCellValue('G' . $row_data, number_format($field->paymentTotal, 2, '.', ''));

                $row_data++;
            }
        }

        //Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Excel_cash_collection_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
