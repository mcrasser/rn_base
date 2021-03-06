<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Rene Nitzsche
 *  Contact: rene@system25.de
 *  All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 ***************************************************************/

/**
 * Wrapperclass for TYPO3 Extension Manager
 * @author René Nitzsche
 */
class tx_rnbase_util_Extensions
{

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($method, array $arguments)
    {
        return call_user_func_array(array(static::getExtensionManagementUtilityClass(), $method), $arguments);
    }

    /**
     * @return \TYPO3\CMS\Core\Utility\ExtensionManagementUtility or t3lib_extMgm
     */
    protected static function getExtensionManagementUtilityClass()
    {
        if (tx_rnbase_util_TYPO3::isTYPO60OrHigher()) {
            $class = '\TYPO3\CMS\Core\Utility\ExtensionManagementUtility';
        } else {
            $class = 't3lib_extMgm';
        }

        return $class;
    }

    /**
     * Registers an Extbase module (main or sub) to the backend interface.
     * FOR USE IN ext_tables.php FILES
     *
     * @param string $extensionName
     * @param string $mainModuleName
     * @param string $subModuleName
     * @param string $position
     * @param array $controllerActions
     * @param array $moduleConfiguration
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public static function registerModule(
        $extensionName,
        $mainModuleName = '',
        $subModuleName = '',
        $position = '',
        array $controllerActions = array(),
        array $moduleConfiguration = array()
    ) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            $extensionName,
            $mainModuleName,
            $subModuleName,
            $position,
            $controllerActions,
            $moduleConfiguration
        );
    }
}
