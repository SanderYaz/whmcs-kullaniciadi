<?php
// *************************************************************************
// *                                                                       *
// * WHMCS Kullanıcı Adı - The Complete Username Module    *
// * Copyright (c) APONKRAL. All Rights Reserved,                         *
// * Version: 1.0.1 (1.0.1release.1)                                      *
// * BuildId: 20190522.001                                                  *
// * Build Date: 22 May 2019                                               *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: bilgi[@]aponkral.net                                                 *
// * Website: https://aponkral.net                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.  This software  or any other *
// * copies thereof may not be provided or otherwise made available to any *
// * other person.  No title to and  ownership of the  software is  hereby *
// * transferred.                                                          *
// *                                                                       *
// * You may not reverse  engineer, decompile, defeat  license  encryption *
// * mechanisms, or  disassemble this software product or software product *
// * license.  APONKRAL may terminate this license if you don't *
// * comply with any of the terms and conditions set forth in our end user *
// * license agreement (EULA).  In such event,  licensee  agrees to return *
// * licensor  or destroy  all copies of software  upon termination of the *
// * license.                                                              *
// *                                                                       *
// * Please see the EULA file for the full End User License Agreement.     *
// *                                                                       *
// *************************************************************************
// Her şeyi sana yazdım!.. Her şeye seni yazdım!.. * Mustafa Kemal ATATÜRK

if (!defined("WHMCS")) {
	die("This file cannot be accessed directly. This module was made by APONKRAL.");
exit();
}

// use WHMCS (Laravel) db functions
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 *
 * Module configuration
 *
 */

/**
 *
 * Get firstname and lastname details from DB using user email
 *
 * @param $email string user email
 *
 * @return array firstname and lastname keys with first/lastname values
 */

function kullaniciadi_find_user_details($email)
{
	$retArr = [];
	$details = Capsule::table('tblclients')
				->select('id', 'firstname', 'lastname')
				->where('email', $email)
				->first();

	$retArr["id"] = $details->id;
	$retArr["firstname"] = $details->firstname;
	$retArr["lastname"] = $details->lastname;

	return $retArr;
}

/**
 *
 * Get all custom field names and ids from database
 *
 * @param none
 *
 * @return array field names concat with ids - format: "id|name"
 */

function kullaniciadi_get_custom_fields()
{
	$field_names = Capsule::table('tblcustomfields')->select('fieldname', 'id')
				->get();
	$retVal = [];
	foreach ($field_names as $value) {
		array_push($retVal, $value->id . "|" . $value->fieldname);
	}
	return $retVal;
}

/**
 *
 * Return a CSV string from a PHP array
 * Taken from https://gist.github.com/johanmeiring/2894568
 *
 * @param array $csv_array An array of values
 *
 * @return string Comma seperated values of custom field names
 */

if (!function_exists('str_putcsv')) {
	function str_putcsv($input, $delimiter = ',', $enclosure = "'") {
		$fp = fopen('php://temp', 'r+b');
		fputcsv($fp, $input, $delimiter, $enclosure);
		rewind($fp);
		$data = rtrim(stream_get_contents($fp), "\n");
		fclose($fp);
		return $data;
	}
}

/**
 *
 * Get modules configuration fields for hooks
 *
 * @param none
 *
 * @return array Module configuration fields
 */

function kullaniciadi_get_module_conf()
{
	$retVal = [];
	$exclude_fields = ['version', 'access',];
	$results = Capsule::table('tbladdonmodules')->select('setting', 'value')
			->where('module', 'kullaniciadi')
			->whereNotIn('setting', $exclude_fields)
			->get();
	foreach ($results as $row)
	{
		list($value, $rest) = explode("|", $row->value , 2);
		$retVal[$row->setting] = str_replace("'", "", $value);
	}
	return $retVal;
}