<?php

/***************************************************************************
*                            Dolphin Smart Community Builder
*                              -------------------
*     begin                : Mon Mar 23 2006
*     copyright            : (C) 2007 BoonEx Group
*     website              : http://www.boonex.com
* This file is part of Dolphin - Smart Community Builder
*
* Dolphin is free software; you can redistribute it and/or modify it under
* the terms of the GNU General Public License as published by the
* Free Software Foundation; either version 2 of the
* License, or  any later version.
*
* Dolphin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
* without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
* See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Dolphin,
* see license.txt file; if not, write to marketing@boonex.com
***************************************************************************/

bx_import("BxDolInstaller");

class BxMapInstaller extends BxDolInstaller {
    function BxMapInstaller($aConfig) {
        parent::BxDolInstaller($aConfig);
    }

    function install($aParams) {

        $aResult = parent::install($aParams);

        $this->addExceptionsFields (array ('POST.bx_map_key', 'REQUEST.bx_map_key')); 

        return $aResult;
    }    
    
    function uninstall() {        

        $ret = parent::uninstall(array());

        $this->removeExceptionsFields ();

        return $ret;
    }    
}
?>
