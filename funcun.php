<?php

//get module api omise php and load wordpress modle
require_once 'C:/xampp/htdocs/woocom/wp-content/plugins/omise/includes/libraries/omise-php/lib/Omise.php';
require('C:/xampp/htdocs/woocom/wp-load.php');
/* require_once dirname(__FILE__).'/vendor/autoload.php'; */

define('OMISE_PUBLIC_KEY', 'P_API_YOU');
define('OMISE_SECRET_KEY', 'S_API_YOU');
define('OMISE_API_VERSION', '2019-05-29');

echo "<pre>";
print_r($_POST);
echo "</pre>";

//create customer whit token 
$customer = OmiseCustomer::create(array(
    'email' => 'john.doe@example.com',
    'description' => 'John Doe (id: 30)',
    'card' => $_POST['omiseToken']
  ));
  
print_r($customer);

//create schedule customerID , cardID <<-- use
$scheduler = OmiseCharge::schedule(array(
      'customer'    => $customer['id'],
      'card'        => $customer['default_card'],
      'amount'      => 100000, //fix how recive price 
      'description' => 'Membership fee'
  ));

//include function calculate date to use for customer

$schedule = $scheduler->every(1)
                    ->months(array(25))
                    ->startDate('2022-01-25') 
                    ->endDate('2024-02-25')
                    ->start();
?>