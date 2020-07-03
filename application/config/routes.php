<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site/home';

$route['dashboard'] = 'dashboard/home';
$route['events'] = 'dashboard/events';
$route['themes'] = 'dashboard/themes';
$route['foods'] = 'dashboard/foods';
$route['items'] = 'dashboard/items';
$route['packages'] = 'dashboard/packages';
$route['reservations'] = 'dashboard/reservations';

$route['show-packages-area'] = 'site/packageArea';

$route['get-notifications'] = 'dashboard/reservations/fetchNewReservations';


$route['my-reservation'] = 'site/myReservation';
$route['show-reservation/(:num)'] = 'site/myReservation/showReservation/$1';
$route['event-themes/(:num)'] = 'dashboard/packages/fetchThemesByEvent/$1';


$route['find-reservation'] = 'site/myReservation/findReservation';

$route['cancel-reservation/(:num)'] = 'site/myReservation/setAsCancelled/$1';

$route['reserve/upload'] = 'site/reserve/do_upload';
$route['reserve/get-venue/(:num)'] = 'site/reserve/getSingleVenue/$1';

$route['site/save-custom'] = 'site/SaveCustomDetails';


$route['admin-logs'] = 'dashboard/adminLogs';
$route['get-logs'] = 'dashboard/adminLogs/getLogs';


$route['contents'] = 'dashboard/contents';
$route['save-term'] = 'dashboard/contents/saveTerm';
$route['update-term/(:num)'] = 'dashboard/contents/updateTerm/$1';
$route['delete-term/(:num)'] = 'dashboard/contents/deleteTerm/$1';
$route['get-term/(:num)'] = 'dashboard/contents/getSingleTerm/$1';

$route['save-about'] = 'dashboard/contents/saveAbout';
$route['update-about'] = 'dashboard/contents/updateAbout';


$route['venues'] = 'dashboard/venue';
$route['venues/get-single/(:num)'] = 'dashboard/venue/fetchSingle/$1';
$route['venues/create'] = 'dashboard/venue/create';
$route['venues/store'] = 'dashboard/venue/store';
$route['venues/do_upload'] = 'dashboard/venue/do_upload';
$route['venues/update/(:num)'] = 'dashboard/venue/update/$1';
$route['venues/delete/(:num)'] = 'dashboard/venue/delete/$1';

// events
$route['events/create'] = 'dashboard/events/create';
$route['events/store'] = 'dashboard/events/store';
$route['events/update/(:num)'] = 'dashboard/events/update/$1';
$route['events/upload'] = 'dashboard/events/do_upload';
$route['events/(:num)'] = 'dashboard/events/view/$1';
$route['delete-events/(:num)'] = 'dashboard/events/delete/$1';


$route['themes/create'] = 'dashboard/themes/create';
$route['themes/(:num)'] = 'dashboard/themes/view/$1';
$route['themes/store'] = 'dashboard/themes/store';
$route['themes/update/(:num)'] = 'dashboard/themes/update/$1';
$route['themes/upload'] = 'dashboard/themes/do_upload';
$route['themes/status/(:num)'] = 'dashboard/themes/changeStatus/$1';
$route['dashboard/get-themes'] = 'dashboard/themes/getThemes';

$route['foods/create'] = 'dashboard/foods/create';
$route['foods/(:num)'] = 'dashboard/foods/view/$1';
$route['foods/store'] = 'dashboard/foods/store';
$route['foods/update/(:num)'] = 'dashboard/foods/update/$1';
$route['foods/status/(:num)'] = 'dashboard/foods/changeStatus/$1';
$route['foods/upload'] = 'dashboard/foods/do_upload';
$route['dashboard/get-foods'] = 'dashboard/foods/getFoods';
$route['foods/category/store'] = 'dashboard/foods/createCategory';
$route['delete/food-category/(:num)'] = 'dashboard/foods/deleteFoodCategory/$1';

$route['delete/category/(:num)'] = 'dashboard/items/deleteCategory/$1';

// items
$route['items/create'] = 'dashboard/items/create';
$route['items/store'] = 'dashboard/items/store';
$route['items/upload'] = 'dashboard/items/do_upload';
$route['items/(:num)'] = 'dashboard/items/get/$1';
$route['items/update/(:num)'] = 'dashboard/items/update/$1';
$route['items/delete/(:num)'] = 'dashboard/items/delete/$1';

$route['category/create'] = 'dashboard/items/addCategory';


$route['past-events'] = 'dashboard/pastEvents';
$route['past-events/(:num)'] = 'dashboard/pastEvents/view/$1';
$route['past-events/create'] = 'dashboard/pastEvents/create';
$route['past-events/store'] = 'dashboard/pastEvents/store';
$route['past-events/upload'] = 'dashboard/pastEvents/do_upload';
$route['past-events/update/(:num)'] = 'dashboard/pastEvents/update/$1';

$route['past-events/update-upload'] = 'dashboard/pastEvents/uploadUpdate';

$route['past-events/update-featured'] = 'dashboard/pastEvents/updateFeatured';

$route['reservations/(:num)'] = 'dashboard/reservations/view/$1';
$route['reservations/status/(:num)'] = 'dashboard/reservations/updateStatus/$1';
$route['reservations/cancel/(:num)'] = 'dashboard/reservations/cancelReservation/$1';
$route['get-reservations-number/(:any)/(:any)'] = 'dashboard/home/getMonthlyReservations/$1/$2';
$route['get-sales-count/(:any)/(:any)'] = 'dashboard/home/getMonthlySales/$1/$2';

$route['reservations/massreject'] = 'dashboard/reservations/rejectReservations';
$route['reservations/ce/(:num)'] = 'dashboard/reservations/confirmationEmail/$1';

$route['reservations/pending'] = 'dashboard/reservations/getPendingReservations';
$route['reservations/confirmed'] = 'dashboard/reservations/getConfirmedReservations';
$route['reservations/rejected'] = 'dashboard/reservations/getRejectedReservations';

$route['sales'] = 'dashboard/sales';
$route['get-sales/(:num)'] = 'dashboard/sales/getAllSales/$1';
$route['get-sales/(:num)/(:num)'] = 'dashboard/sales/getSalesByMonth/$1/$2';

$route['sales-report/(:num)'] = 'dashboard/sales/generateReport/$1';
$route['sales-report/(:num)/(:num)'] = 'dashboard/sales/generateReport/$1/$2';
$route['sales-report/(:num)/(:num)/(:any)/(:any)'] = 'dashboard/sales/generateReport/$1/$2/$3/$4';

$route['items-report'] = 'dashboard/items/generateReport';

$route['reservation-report/(:num)/(:any)'] = 'dashboard/reservations/generateReport/$1/$2';
$route['reservation-report/(:num)/(:any)/(:num)'] = 'dashboard/reservations/generateReport/$1/$2/$3';
$route['reservation-report/(:num)/(:any)/(:num)/(:any)/(:any)'] = 'dashboard/reservations/generateReport/$1/$2/$3/$4/$5';



$route['dashboard/login'] = 'dashboard/home/login';
$route['dashboard/checklogin'] = 'dashboard/home/checkLogin';

$route['dashboard/logout'] = 'dashboard/home/logout';

// packages
$route['packages/create'] = 'dashboard/packages/create';
$route['packages/store'] = 'dashboard/packages/store';
$route['packages/(:num)'] = 'dashboard/packages/view/$1';
$route['packages/update/(:num)'] = 'dashboard/packages/update/$1';
$route['packages/delete/(:num)'] = 'dashboard/packages/delete/$1';
$route['packages/upload'] = 'dashboard/packages/do_upload';

$route['get-packages'] = 'dashboard/packages/getPackages';
$route['get-items'] = 'dashboard/items/getItems';


$route['reservations/deploy-items'] = 'dashboard/reservations/subtractAvailability';
$route['reservations/complete'] = 'dashboard/reservations/markAsComplete';


// site
$route['home'] = 'site/home';
$route['about'] = 'site/about';

$route['custom/package/(:any)'] = 'site/customizedPackage/index/$1';
$route['custom/build-items'] = 'site/customizedPackage/buildItems';
$route['custom/get-items'] = 'site/customizedPackage/getItemsInCart';
$route['custom/remove/(:num)'] = 'site/customizedPackage/removeItem/$1';
$route['custom/clear-cart'] = 'site/customizedPackage/clearCart';


$route['past-event/(:num)'] = 'site/home/showPastEventModal/$1';
$route['send-code'] = 'site/reserve/sendCode';
$route['check-code'] = 'site/reserve/verifyCode';

$route['clients/events'] = 'site/pastEvents';

$route['get-packages/(:num)'] = 'site/home/getPackagesByEventId/$1';
$route['site/get-package/(:num)'] = 'site/home/getPackageById/$1';

$route['registration'] = 'site/users/create';
$route['registration/store'] = 'site/users/store';
$route['reservation'] = 'site/reserve';
$route['reservation/process'] = 'site/reserve/process';
$route['prepareData/(:num)/(:any)'] = 'site/PrepareReservation/index/$1/$2';
$route['prepareData'] = 'site/PrepareReservation';
$route['details/(:any)/(:num)'] = 'site/details/index/$1/$2';
$route['get-available-dates'] = 'site/home/getReservedDates';
$route['get-packages/(:num)'] = 'site/home/getPackagesByEventId/$1';
$route['login'] = 'site/users/processLogin';
$route['logout'] = 'site/users/logout';

$route['site/event/(:num)'] = 'site/sitePackages/index/$1';
$route['site/package/(:num)'] = 'site/sitePackages/viewPackage/$1';

$route['site/build/(:num)'] = 'site/buildPackage/index/$1';

$route['site/get-item-image/(:num)'] = 'site/reserve/getItemImage/$1';
$route['site/get-food-image/(:num)'] = 'site/reserve/getFoodImage/$1';

$route['site/get-items/(:num)'] = 'site/buildPackage/buildGetItemsByCat/$1';
$route['site/get-foods/(:num)'] = 'site/buildPackage/buildGetFoodByCat/$1';

$route['custom/get-item/(:num)'] = 'site/customizedPackage/getItemsByCategory/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
