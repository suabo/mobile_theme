<?php
/**
 * #PHPHEADER_OXID_LICENSE_INFORMATION#
 *
 * @link      http://www.oxid-esales.com
 * @package   views
 * @copyright (c) OXID eSales AG 2003-#OXID_VERSION_YEAR#
 * @version   SVN: $Id$
 */

/**
 * Review of chosen article.
 * Collects article review data, saves new review to DB.
 */
class oemobilethemereview extends oemobilethemereview_parent
{

    /**
     * Returns view ID (for template engine caching).
     *
     * @return string   $this->_sViewId view id
     */
    public function getViewId()
    {
        $sViewId = parent::getViewId();
        $oTheme = oxNew( 'oemobilethemetheme' );
        $sViewId .= $oTheme->getActiveThemeId();

        return $sViewId;
    }

}