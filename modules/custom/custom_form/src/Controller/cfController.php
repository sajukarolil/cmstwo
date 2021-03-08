<?php
/**
 * @file
 * Contains \Drupal\custom_form\cfController.
 */

namespace Drupal\custom_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\Core\Session\AccountInterface;


class cfController extends ControllerBase {

  public function dashboard() {
    global $base_path;	
	
	#Creating headers
	$header = array('Name', 'Email', 'Phone', 'Website URL');
	
	#building query
	$query = db_select('custom_form', 'd')->extend('Drupal\Core\Database\Query\PagerSelectExtender');
	
	# get the desired fields from the database
	$query->fields('d', array('name', 'email', 'phone', 'website_url'))
        ->orderBy('Name', 'ASC')
        ->limit(20);
		
	# execute the query
	$results = $query->execute();	
	
	# build the table fields
	$rows = array();
	foreach ($results as $row) {
		$rows[] = array( $row->name, $row->email, $row->phone, $row->website_url);
	}
		
	#Output creation in Table
	    $output = [];
		
		$output[] = array(
			'#type' => 'table',
			'#header' => $header,
			'#rows' => $rows,
			'#empty' => t('There is no guest details added yet.'),
			'#attributes' => array(
			'id' => 'nam_guest_users',
			),
		);
		
		$output[] = ['#type' => 'pager'];
	
		return $output;	
	}
}
 