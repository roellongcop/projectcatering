<?php

include_once APPPATH. 'libraries/ImageResize.php';
include_once APPPATH. 'libraries/phpexcel/Classes/PHPExcel.php';

use \Eventviva\ImageResize;

class Items extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ItemsModel', 'item');
		$this->load->model('PackageModel', 'package');
	}

	public function index()
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}
		$data['active_page'] = 'items';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$data['categories'] = $this->item->fetchCategories();

		$dateToday = date('Y-m-d');
		$data['item_availabilities'] = $this->item->getItemsAvailability($dateToday);

		$this->load->view('dashboard/items/index', $data);
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;

        $this->load->library('upload', $config);

       	if ($this->upload->do_upload('file')) {

        	$upload_data = $this->upload->data();

        	@$image = new ImageResize($upload_data['full_path']);
        	@$image->resize(400, 300);
			@$image->save($upload_data['full_path']);

       		$itemImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('item_image', $itemImage);

       		echo 1;

        } else {
        	echo $this->upload->display_errors(); 
        }
	}

	public function generateReport()
	{
		$items = $this->item->getForReport();
	
		if (! empty($items)) {
			foreach ($items as &$val) {
				$val['date_modified'] = date_format(date_create($val['date_modified']), 'F j, Y');
				$val['price'] = 'PHP ' . number_format($val['price']);				
			}
		}

		$totalRows = count($items);
		$currentDate = date('Y-m-d');
		$filename = 'Inventory_' . $currentDate . '.xls';;

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setCreator("Recto\'s Administrator")
							 ->setLastModifiedBy("Recto\'s Administrator")
							 ->setTitle("Recto\'s Inventory Report")
							 ->setSubject("Recto\'s Inventory Report");

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'CATEGORY');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ITEM');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'PRICE PER ITEM');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'REMAINING STOCKS');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'DATE LAST MODIFIED');

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
		        $items,  // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );

		$lastRow = 4 + $totalRows;
		$dateRow = $lastRow + 3;
		$prepRow = $dateRow + 1;
		$dateToday = (new DateTime())->format('F j, Y');

		$objPHPExcel->getActiveSheet()->setCellValue('E'.$lastRow, 'Total Item Inventory: ' . $totalRows);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$dateRow, 'Recto\'s Inventory as of ' . $dateToday);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$prepRow, 'Prepared by Administrator');

        $objPHPExcel->getActiveSheet()->setTitle('Inventory Report');

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

		createLog('Items report generation', 1);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	private function moveImage($uploadedImage, $name) 
	{
		$name = strtolower($name);
		$name = str_replace(' ', '_', $name);

		$images_dir = "./item_images";
		$uploads_dir = './uploads/';
		
		if (!is_dir($images_dir)) {
			mkdir($images_dir, 0777, TRUE);
		}

		$image_name = strtolower($name . '_' . time() . $uploadedImage['ext']);
		$image_name = str_replace('', '_', $image_name);

		$full_temp_path = $uploadedImage['full_path'];

		$transfer = rename($full_temp_path, "$images_dir/$image_name");

		if ($transfer)  {
			return [
				'current_path' => $images_dir.'/'.$image_name,
				'image_name' => $image_name
			];
		}
		else {
			return false;
		}

	}

	public function getItems() 
	{
		$items = $this->item->fetch();

		foreach ($items as $key => &$val) {
			$val['info_button'] = '<span class="info updateItemBtn" data-id="'.$val['id'].'"> <i class="fa fa-pencil" aria-hidden="true"></i> UPDATE</span> &nbsp;<span  class="delete btnDeleteItem" data-id="'.$val['id'].'"><i class="fa fa-trash" aria-hidden="true"></i> ARCHIVE </a>';
		}

		$items = ['data' => $items];

		echo json_encode($items);
	}

	public function delete($id) 
	{
		$superItem = $this->item->fetch($id);
		$packages = $this->package->fetch();
		$packageNames = [];

		foreach ($packages as $key => $val) {
			$decodedPackageItems = json_decode($val['items'], true);
			$ids = array_column($decodedPackageItems, 'id');

			$needle = in_array($superItem[0]['id'], $ids);
		}

		if ($needle) {
			echo json_encode(['success' => 0, 'error_message' => 'Item is in one the packages. Remove first before deleting.']);
		} else {
			$delete = $this->item->delete($id);

			if ($delete) {
				echo json_encode(['success' => 1]);	
			} else {
				echo json_encode(['success' => 0, 'error_message' => 'An error occured. Please try again.']);
			}
		}
	}

	public function deleteCategory($id)
	{
		$result = $this->item->deleteCategory($id);

		echo $result;
	}

	public function create()
	{
		$data['active_page'] = 'items';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);


		$this->load->view('dashboard/items/create', $data);
	}

	public function addCategory()
	{
		$post = $this->input->post();

		$result = $this->item->createCategory($post);

		echo $result;
	}

	public function store()
	{
		$post = $this->input->post();

		$uploadedImage = $this->session->userdata('item_image');
	
		if (! empty($uploadedImage)) {
			$itemImage = $this->moveImage($uploadedImage, $post['item_name']);
			$post['image'] = json_encode($itemImage);
		} 

		$result = $this->item->create($post);

		$this->session->unset_userdata('item_image');

		echo $result;
	}

	public function get($itemId)
	{
		$result = $this->item->fetch($itemId);

		if (! is_null($result[0]['image'])) {
			$result[0]['image'] = json_decode($result[0]['image'], true);
		}

		echo json_encode($result[0]);
	}

	public function update($itemId)
	{
		$data = $this->input->post();
		$uploadedImage = $this->session->userdata('item_image');
	
		if (! empty($uploadedImage)) {
			$eventImage = $this->moveImage($uploadedImage, $data['item_name']);
			$data['image'] = json_encode($eventImage);
		} 
		
		$result = $this->item->update($itemId, $data);

		$this->session->unset_userdata('item_image');

		echo json_encode($result);
	}
}