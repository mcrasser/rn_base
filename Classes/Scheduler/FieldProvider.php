<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

tx_rnbase::load('tx_rnbase_util_TYPO3');
if (tx_rnbase_util_TYPO3::isTYPO60OrHigher()) {
	require_once(tx_rnbase_util_Extensions::extPath('rn_base') . 'Classes/Scheduler/FieldProviderSince6.php');
} else {
	require_once(tx_rnbase_util_Extensions::extPath('rn_base') . 'Classes/Scheduler/FieldProviderTill6.php');
}
