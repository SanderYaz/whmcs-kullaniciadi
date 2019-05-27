<?php
/**
    * WHMCS Kullanıcı Adı Modülü
    *
    * Turkish: WHMCS için Kullanıcı Adı modülü.
    * English: Username module for WHMCS.
    * Version: 1.0.2 (1.0.2release.1)
    * BuildId: 20190527.001
    * Build Date: 27 May 2019
    * Email: bilgi[@]aponkral.net
    * Website: https://aponkral.net
    *
    * @license Apache License 2.0
*/
// Her şeyi sana yazdım!.. Her şeye seni yazdım!.. *Mustafa Kemal ATATÜRK

if (!defined("WHMCS")) {
	die("This file cannot be accessed directly. This module was made by APONKRAL.");
exit();
}

require_once('helpers.php');

function kullaniciadi_config() {
	$db_field_names = str_putcsv(kullaniciadi_get_custom_fields());
	$configarray = [
	"name" => "Kullanıcı Adı",
	"description" => "WHMCS için kullanıcı adı modülü.",
	"premium" => true,
	"version" => "1.0.2",
	"author" => "APONKRAL",
	"link" => "https://aponkral.net/",
	"language" => "turkish",
		"fields" => [
			"username_field" => [
				"FriendlyName" => "Kullanıcı Adı Özel Alanı",
				"Type" => "dropdown",
				"Options" => $db_field_names,
				"Description" => "Özel alanlarınız arasından Kullanıcı Adı için olanı seçin.",
			],
			"admin_username" => [
				"FriendlyName" => "Yönetici Kullanıcı Adı",
				"Type" => "text",
				"Size" => 25,
				"Description" => "WHMCS yönetim paneline giriş yaparken kullandığınız yönetici kullanıcı adını yazın. * Boş olamaz.",
			],
			"reserve_usernames" => [
				"FriendlyName" => "Kullanıcı Adı Rezervesi",
				"Type" => "yesno",
				"Size" => "25",
				"Description" => "Kullanıcı adlarını rezerve etmek için etkinleştirin.",
				"Default" => "on",
			],
			"reserved_usernames" => [
				"FriendlyName" => "Rezerve Kullanıcı Adları",
				"Type" => "textarea",
				"Size" => 25,
				"Description" => "Müşterilerin kullanamayacağı rezerve kullanıcı adlarıdır. Kullanıcı adları virgülle ayrılmalıdır. *Bu özellik <b>Kullanıcı Adı Rezervesi</b> ile birlikte çalışabilir.",
				"Default" => "admin, administrator, whmcs, support, web, help, username",
			],
			"unique_username_message" => [
				"FriendlyName" => "Benzersiz Kullanıcı Adı Mesajı",
				"Type" => "text",
				"Size" => 25,
				"Description" => "Başka kullanıcıya ait olan bir kullanıcı adıyla ile yeni kayıt yapılmak veya profil güncellemek istenildiğinde gösterilecek hata yazısı.",
				"Default" => "Bu kullanıcı adı ile kayıtlı bir kullanıcı var.",
			],
		]
	];
	return $configarray;
}

function kullaniciadi_activate() {
	return ['status' => 'success', 'description' => 'Kullanıcı Adı modülü başarıyla etkinleştirildi.'];
}

function kullaniciadi_deactivate() {
    return ['status' => 'success', 'description' => 'Kullanıcı Adı modülü başarıyla pasifleştirildi.'];
}

function kullaniciadi_output($vars) {
$kullaniciadi_config = kullaniciadi_config();

	$module_name = $kullaniciadi_config['name'];
	$module_description = $kullaniciadi_config['description'];
	$module_author = $kullaniciadi_config['author'];
	$author_link = $kullaniciadi_config['link'];
	
    $version = $vars['version'];

function update_check($version) {
if(function_exists('curl_exec')) {
	
	$curl = curl_init();
    $error = [];

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://raw.githubusercontent.com/aponkral/whmcs-kullaniciadi/master/version.txt",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYHOST => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 5,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => [
        "content-type: text/plain; charset=utf-8",
		"user-agent: APONKRAL.APPS/WHMCS-Kullanici-Adi",
      ],
    ]);
    $currentversion = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($currentversion)
    {
        
	if($version == $currentversion)
		return "<p style=\"color: #4CAF50;\">Kullanıcı Adı modülü güncel.</p>";
	else
		return "<p style=\"color: #F44336;\">Kullanıcı Adı modülü güncel değil! (<i style=\"color: #607D8B;\">Güncel sürüm: " . $currentversion . "</i>)</p><p style=\"color: #616161;\">Modülü güncellemek istiyorsanız <a href=\"https://github.com/aponkral/whmcs-kullaniciadi\" target=\"_blank\" title=\"WHMCS Kullanıcı Adı modülü\" style=\"color: #2196F3;\">GitHub'dan</a> Modülü indirerek WHMCS ana dizinininden <strong>modules/addons/</strong> klasörüne yükleyin.</p><p style=\"color: #424242;\">Lütfen dosyaları güncelledikten sonra bu sayfaya tekrar bakın.</p>";
    }

    if ($err)
    {
		return "<p style=\"color: #F44336;\">GitHub Raw Sunucusu ile bağlantı kurulamıyor. Lütfen daha sonra tekrar deneyiniz.</p>";
    }

} else {
		return "<p style=\"color: #F44336;\">API Sunucusu ile bağlantı kurulması için sunucunuzda <i>curl_exec</i> fonksiyonunun aktif olması gerekir.</p>";
}
}

$is_module_up_to_date = update_check($version);

echo "<table class=\"table table-bordered\">
				<tbody>
					<tr>
						<td><b style=\"color: #212121;\">Modül adı</b></td>
						<td>" . $module_name . "</td>
					</tr>
					<tr>
						<td><b style=\"color: #212121;\">Modül açıklaması</b></td>
						<td>" . $module_description . "</td>
					</tr>
					<tr>
						<td><b style=\"color: #212121;\">Modül sürümü</b></td>
						<td>" . $version . "</td>
					</tr>
					<tr>
						<td><b style=\"color: #212121;\">Modülü geliştiren</b></td>
						<td><a href=\"" . $author_link . "\" target=\"_blank\" title=\"APONKRAL Blog\" style=\"color: #2196F3;\">" . $module_author . "</a></td>
					</tr>
					<tr>
						<td class=\"text-center\" colspan=\"2\">" . $is_module_up_to_date . "</td>
					</tr>
				</tbody>
			</table>";

echo "<br /></div>";

}

function kullaniciadi_clientarea($vars) {
$conf = kullaniciadi_get_module_conf();

	$modulelink = $vars['modulelink'];

	$kullaniciadi_config = kullaniciadi_config();

	$module_name = $kullaniciadi_config['name'];
	$module_description = $kullaniciadi_config['description'];
	$author_name = $kullaniciadi_config['author'];
	$author_link = $kullaniciadi_config['link'];

return [
		'pagetitle' => 'Kullanıcı Adı',
		'breadcrumb' => [$modulelink=>'Kullanıcı Adı'],
		'templatefile' => 'templates/index',
		'requirelogin' => false, # accepts true/false
		'forcessl' => false, # accepts true/false
		'vars' => [
			'module_name' => $module_name,
			'module_description' => $module_description,
			'author_name' => $author_name,
			'author_link' => $author_link,
		],
	];
}