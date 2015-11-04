<?php

/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolModuleDb');

class BxMbpDb extends BxDolModuleDb
{
    var $_oConfig;
    /*
     * Constructor.
     */
    function BxMbpDb(&$oConfig)
    {
        parent::BxDolModuleDb($oConfig);

        $this->_oConfig = &$oConfig;
    }

    function getMembershipsBy($aParams = array())
    {
        $sMethod = "getAll";
        $sSelectClause = $sJoinClause = $sWhereClause = $sOrderClause = $sLimitClause = "";
        if(isset($aParams['type']))
            switch($aParams['type']) {
                case 'price_id':
                    $sMethod = "getRow";
                    $sSelectClause .= ", `tlp`.`id` AS `price_id`, `tlp`.`Days` AS `price_days`, `tlp`.`Price` AS `price_amount`";
                    $sJoinClause .= "LEFT JOIN `sys_acl_level_prices` AS `tlp` ON `tl`.`ID`=`tlp`.`IDLevel`";
                    $sWhereClause .= " AND `tl`.`Active`='yes' AND `tl`.`Purchasable`='yes' AND `tlp`.`id`='" . $aParams['id'] . "'";
                    break;
                case 'price_all':
                    $sSelectClause .= ", `tlp`.`id` AS `price_id`, `tlp`.`Days` AS `price_days`, `tlp`.`Price` AS `price_amount`";
                    $sJoinClause .= "INNER JOIN `sys_acl_level_prices` AS `tlp` ON `tl`.`ID`=`tlp`.`IDLevel`";
                    $sWhereClause = " AND `tl`.`Active`='yes' AND `tl`.`Purchasable`='yes'";
                    $sOrderClause = " ORDER BY `tl`.`Order` ASC, `tlp`.`Price` ASC";
                    break;
                case 'level_id':
                    $sMethod = "getRow";
                    $sWhereClause .= " AND `tl`.`ID`='" . $aParams['id'] . "'";
                    break;
            }

        $sSql = "SELECT
                `tl`.`ID` AS `mem_id`,
                `tl`.`Name` AS `mem_name`,
                `tl`.`Icon` AS `mem_icon`,
                `tl`.`Description` AS `mem_description` " . $sSelectClause . "
            FROM `sys_acl_levels` AS `tl` " . $sJoinClause . "
            WHERE 1" . $sWhereClause . $sOrderClause . $sLimitClause;
       return $this->$sMethod($sSql);
    }
}