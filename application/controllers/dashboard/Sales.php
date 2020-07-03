<?php

include_once APPPATH. 'libraries/phpexcel/Classes/PHPExcel.php';

class Sales extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SalesModel', 'sales');
	}

	public function index()
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}
		$data['active_page'] = 'sales';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$data['year'] = date('Y');
		$data['month'] = date('F');

		$this->load->view('dashboard/sales/index', $data);
	}

	public function generateReport($year, $month = null, $startDate = null, $endDate = null)
	{
		$sales = $this->sales->getForRecords($year, $month, $startDate, $endDate);
	
		$totalSales = 0;

		if (! empty($sales)) {
			foreach ($sales as &$val) {

				$totalSales += $val['total_amount'];

				$val['date_of_event'] = date_format(date_create($val['date_of_event']), 'F j, Y');
				$val['total_amount'] = 'PHP ' . number_format($val['total_amount'], 2);
				$val['date_of_reservation'] = date_format(date_create($val['date_of_reservation']), 'F j, Y');
				$val['package_name'] = (is_null($val['package_name'])) ? ' Custom Package' : $val['package_name'];				
			}
		}

		$totalRows = count($sales);
		$filename = 'Sales_Report.xls';

		if (! is_null($year) && is_null($month) && is_null($startDate)) {
			$filename = $year.'_Sales_Report.xls';
		}

		if (! is_null($year) && ! is_null($month) && is_null($startDate)) {
			$dateObj   = DateTime::createFromFormat('!m', $month);
			$monthName = $dateObj->format('F');
			$filename = $monthName.'_'.$year.'_Sales_Report.xls';
		}

		if (! is_null($year) && $month == 0 && ! is_null($startDate)) {
			$filename = 'Custom_Sales_Report.xls';
		}

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setCreator("Recto\'s Administrator")
							 ->setLastModifiedBy("Recto\'s Administrator")
							 ->setTitle("Recto\'s Sales Report")
							 ->setSubject("Recto\'s Sales Report");

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'CONFIRMATION CODE');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'CUSTOMER NAME');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'DATE OF EVENT');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'CUSTOMER CONTACT');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'DATE OF RESERVATION');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'PACKAGE');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'TOTAL AMOUNT');

		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

		    $sheet = $objPHPExcel->getActiveSheet();
		    $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(true);
		    /** @var PHPExcel_Cell $cell */
		    foreach ($cellIterator as $cell) {
		        $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
		    }
		}

		$objPHPExcel->getActiveSheet()
		    ->fromArray(
		        $sales,  // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );

		$lastRow = 4 + $totalRows;
		$dateRow = $lastRow + 3;
		$prepRow = $dateRow + 1;
		$dateToday = (new DateTime())->format('F j, Y');

		$objPHPExcel->getActiveSheet()->setCellValue('F'.$lastRow, 'Total Sales: ');
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$lastRow, 'PHP ' . number_format($totalSales, 2));
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$dateRow, 'Recto\'s Sales as of ' . $dateToday);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$prepRow, 'Prepared by Administrator');

        $objPHPExcel->getActiveSheet()->setTitle('Sales Report');

        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		createLog('Sales report generation', 1);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function getSalesByMonth($year, $month = null) 
	{
		$data = $this->sales->fetch($year, $month);

		if (! empty($data)) {
			foreach ($data as &$val) {
				$val['date_of_event'] = date_format(date_create($val['date_of_event']), 'F j, Y');
				$val['total_amount'] = 'PHP ' . number_format($val['total_amount'], 2);
				$val['date_of_reservation'] = date_format(date_create($val['date_of_reservation']), 'F j, Y');
				$val['package_name'] = (is_null($val['package_name'])) ? ' Custom Package' : $val['package_name'];
			}
		}

		$data = ['data' => $data];

		echo json_encode($data);
	}

	public function getAllSales($year)
	{
		$data = $this->sales->fetch($year);

		if (! empty($data)) {
			foreach ($data as &$val) {
				$val['date_of_event'] = date_format(date_create($val['date_of_event']), 'F j, Y');
				$val['total_amount'] = 'PHP ' . number_format($val['total_amount'], 2);
				$val['date_of_reservation'] = date_format(date_create($val['date_of_reservation']), 'F j, Y');
				$val['package_name'] = (is_null($val['package_name'])) ? ' Custom Package' : $val['package_name'];
			}
		}

		$data = ['data' => $data];

		echo json_encode($data);
	}

}