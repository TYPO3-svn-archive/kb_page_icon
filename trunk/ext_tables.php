<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$tempColumns = Array (
	"tx_kbpageicon_pticon" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:kb_page_icon/locallang_db.xml:pages.tx_kbpageicon_pticon",		
		"config" => Array (
			"type" => "group",
			"internal_type" => "file",
			"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],	
			"max_size" => 1000,	
			"uploadfolder" => "uploads/tx_kbpageicon",
			"show_thumbs" => 1,	
			"size" => 1,	
			"minitems" => 0,
			"maxitems" => 1,
		)
	),
);


t3lib_div::loadTCA("pages");
t3lib_extMgm::addTCAcolumns("pages",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("pages","tx_kbpageicon_pticon;;;;1-1-1");


$data = false;
$cacheFile = t3lib_extMgm::extPath('kb_page_icon', 'iconListCache.ser');
if (file_exists($cacheFile))	{
	$data = unserialize(t3lib_div::getURL($cacheFile));
}
if (!is_array($data))	{
	$store = array();
	$pages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, module', 'pages', 'module LIKE \'ICON:%\'');
	if (is_array($pages))	{
		foreach ($pages as $page)	{
			$icon = substr($page['module'], 5);
			$store[$page['module']]['icon'] = '../uploads/tx_kbpageicon/'.$icon;
		}
	}
	t3lib_div::writeFile($cacheFile, serialize($store));
} else	{
	$ICON_TYPES = t3lib_div::array_merge_recursive_overrule($ICON_TYPES, $data);
}

?>
