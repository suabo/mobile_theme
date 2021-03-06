<?php
/**
 * This file is part of OXID eSales theme switcher module.
 *
 * OXID eSales theme switcher module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales theme switcher module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with OXID eSales theme switcher module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2013
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_oeThemeSwitcher_Core_oeThemeSwitcherViewConfigTest extends OxidTestCase
{
    /**
     * oxViewConfig::oeThemeSwitcherGetEdition()
     */
    public function testGetEdition()
    {
        $oViewConfig = new oeThemeSwitcherViewConfig();
        $this->assertEquals( $this->getConfig()->getEdition(), $oViewConfig->oeThemeSwitcherGetEdition() );
    }

    /**
     * Checks if returns user agent instance
     */
    public function testGetUserAgent()
    {
        $oViewConfig = new oeThemeSwitcherViewConfig();
        $this->assertInstanceOf( 'oeThemeSwitcherUserAgent', $oViewConfig->oeThemeSwitcherGetUserAgent() );
    }

    /**
     * Module data provider.
     */
    public function _dpIsModuleActive()
    {
        return array(
            array( array( 'order' => 'oe/oepaypal/controllers/oepaypalorder' ), array(),                  'oepaypal', true ),
            array( array( 'order' => 'oe/oepaypal/controllers/oepaypalorder' ), array( 0 => 'oepaypal' ), 'oepaypal', false ),
            array( array(),                                                     array(),                  'oepaypal', false ),
            array( array(),                                                     array( 0 => 'oepaypal' ), 'oepaypal', false ),
        );
    }

    /**
     * oxViewConfig::oeThemeSwitcherIsModuleActive()
     * @dataProvider _dpIsModuleActive
     */
    public function testIsModuleActive( $aModules, $aDisabledModules, $sModuleId, $blModuleIsActive )
    {
        $this->setConfigParam( 'aModules', $aModules );
        $this->setConfigParam( 'aDisabledModules', $aDisabledModules );

        $oViewConf = new oeThemeSwitcherViewConfig();
        $blIsModuleActive = $oViewConf->oeThemeSwitcherIsModuleActive( $sModuleId );

        $this->assertEquals( $blModuleIsActive, $blIsModuleActive, "Module state is not as expected." );
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function providerIsModuleActive_VersionCheck()
    {
        return array(
            array( '1.8', null, true ),
            array( '2.0', null, true ),
            array( '2.1', null, false ),
            array( '3.0', null, false ),
            array( null, '1.8', false ),
            array( null, '2.0', false ),
            array( null,'2.1', true ),
            array( null, '3.0', true ),
            array( '1.8', '3.0', true ),
            array( '1.0', '1.7', false ),
            array( '2.1', '3.0', false ),
        );
    }

    /**
     * Testing isModuleAction version check
     *
     * @dataProvider providerIsModuleActive_VersionCheck
     */
    public function testIsModuleActive_VersionCheck( $sFrom, $sTo, $blModuleStateExpected )
    {
        $aModules = array(
            'order' => 'oe/oepaypal/controllers/oepaypalorder',
            'order2' => 'oe/oepaypal2/controllers/oepaypalorder',
        );
        $aModuleVersions = array(
            'oepaypal' => '2.0',
            'oepaypal2' => '5.0'
        );
        $this->setConfigParam( 'aModules', $aModules );
        $this->setConfigParam( 'aDisabledModules', array() );
        $this->setConfigParam( 'aModuleVersions', $aModuleVersions );

        $oViewConf = new oeThemeSwitcherViewConfig();
        $blIsModuleActive = $oViewConf->oeThemeSwitcherIsModuleActive( 'oepaypal', $sFrom, $sTo );

        $this->assertEquals( $blModuleStateExpected, $blIsModuleActive, "Module state is not from '$sFrom' to '$sTo'." );
    }

}
