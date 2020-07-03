<?php


class SitePackages extends CI_Controller
{
	
    public function __construct()
	{
		parent::__construct();
        $this->load->model('EventModel', 'event');
        $this->load->model('PackageModel', 'package');
        $this->load->model('FoodModel', 'food');
        $this->load->model('ItemsModel', 'item');
	}

    public function index($eventId)
    {
        $data['active_page'] = 'site_packages';
        $data['header'] = $this->load->view('site/header', $data, true);
        $data['footer'] = $this->load->view('site/footer', '', true);

        $event = $this->event->fetch($eventId);
        
        if (! empty($event)) {
            $event[0]['image'] = json_decode($event[0]['image'], true);
        }

        $packages = $this->package->fetchByEventId($eventId);
        $this->decodeJSON($packages);

        $data['packages'] = $packages;

        $data['event'] = $event[0];


        $this->load->view('site/sitepackages', $data);
    }

    public function viewPackage($id)
    {
        $data['active_page'] = 'site_packages';
        $data['header'] = $this->load->view('site/header', $data, true);
        $data['footer'] = $this->load->view('site/footer', '', true);

        $package = $this->package->fetchWithTheme($id);
        $foods = $this->food->fetch();
        $items = $this->item->fetch();

        if (! empty($package)) {
            $package[0]['items'] = json_decode($package[0]['items'], true);
            $package[0]['image'] = json_decode($package[0]['image'], true);
            $package[0]['foods'] = json_decode($package[0]['foods'], true);
            $package[0]['theme_image'] = json_decode($package[0]['theme_image'], true);
        }

        foreach ($foods as $key => $food) {
            foreach ($package[0]['foods'] as &$pf) {
                if ($food['id'] == $pf['id']) {
                    $pf['name'] = $food['name'];
                    $pf['image'] = json_decode($food['image'], true);
                }
            }
        }

        foreach ($items as $key => $item) {
            foreach ($package[0]['items'] as &$val) {
                if ($item['id'] == $val['id']) {
                    $val['name'] = $item['name'];
                    $val['image'] = json_decode($item['image'], true);
                }
            }
        }

        $data['food_count'] = count($package[0]['foods']);
        $data['package'] = $package[0];

        $this->load->view('site/package_details', $data);
    }

    public function decodeJSON(&$records)
    {
        if (! empty($records)) {
            foreach ($records as &$val) {
                $val['image'] = json_decode($val['image'], true);
                $val['foods'] = json_decode($val['foods'], true);
            }
        }
    }
}