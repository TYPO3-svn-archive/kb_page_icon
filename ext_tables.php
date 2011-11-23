<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_kbpageicon_pticon' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:kb_page_icon/locallang_db.xml:pages.tx_kbpageicon_pticon',
		'config' => array (
			'type' => 'group',
			'internal_type' => 'file',
			'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			'max_size' => 1000,
			'uploadfolder' => 'uploads/tx_kbpageicon',
			'show_thumbs' => 1,
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
);


t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages', 'tx_kbpageicon_pticon;;;;1-1-1');


$data = FALSE;
$cacheFile = PATH_site . 'typo3temp/tx_kbpageicon_iconListCache.ser';
if (file_exists($cacheFile)) {
	$data = unserialize(t3lib_div::getURL($cacheFile));
}
if (!is_array($data)) {
	$store = array();
	$pages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, module', 'pages', 'module LIKE \'ICON__%\'');
	if (is_array($pages)) {
		foreach ($pages as $page) {
			$icon = preg_replace('/_(.{3})$/', '.\\1', substr($page['module'], 6));
			$store[$page['module']]['icon'] = '../uploads/tx_kbpageicon/' . $icon;
		}
	}
	$error = t3lib_div::writeFileToTypo3tempDir($cacheFile, serialize($store));
	$data = $store;
} 
if (is_array($data)) {
		// t3lib_div::int_from_ver() is deprecated since 4.5.0
	$version = class_exists('t3lib_utility_VersionNumber')
				? t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version)
				: t3lib_div::int_from_ver(TYPO3_version);
	if ($version < 4004000) {
		$ICON_TYPES = t3lib_div::array_merge_recursive_overrule($ICON_TYPES, $data);
	} else {
		foreach ($data as $key => $icon) {
			t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-' . $key, $icon['icon']);
		}
	}
}
?>
