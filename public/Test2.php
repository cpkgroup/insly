<?php
/**
 * Include composer autoloader
 */
include getenv('VENDOR_PATH') . 'autoload.php';

use App\Controller\PolicyController;

$policyController = new PolicyController();
$carValue = $_GET['carValue'] ?? 0;
$tax = $_GET['tax'] ?? 0;
$numberOfInstallments = $_GET['numberOfInstallments'] ?? 1;
$result = $policyController->calculateAction((int)$carValue, (int)$tax, (int)$numberOfInstallments);

header('Content-Type: application/json');
echo json_encode($result);
