<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolFilesModule');
define('PROFILE_VIDEO_CATEGORY', 'Profile videos');

class BxVideosModule extends BxDolFilesModule
{
    function BxVideosModule (&$aModule)
    {
        parent::BxDolFilesModule($aModule);

        // add more sections for administration
        $this->aSectionsAdmin['processing'] = array('exclude_btns' => 'all');
        $this->aSectionsAdmin['failed'] = array(
            'exclude_btns' => array('activate', 'deactivate', 'featured', 'unfeatured')
        );
    }
    
    function actionGetFile($iFileId)
    {
        $aInfo = $this->_oDb->getFileInfo(array('fileId'=>(int)$iFileId), false, array('medID', 'medProfId', 'medUri', 'albumId', 'Approved'));
        if ($aInfo && $this->isAllowedDownload($aInfo)) {

            $sPathFull = $this->_oConfig->getFilesPath() . $aInfo['medID'] . '.';
            $sExt = getSettingValue('video', "usex264") == TRUE_VAL ? 'm4v' : 'flv';
            $sPathFull .= $sExt;
            if (file_exists($sPathFull)) {
                $this->isAllowedDownload($aInfo, true);
                header('Connection: close');
                header('Content-Type: video/x-' . $sExt);
                header('Content-Length: ' . filesize($sPathFull));
                header('Last-Modified: ' . gmdate('r', filemtime($sPathFull)));
                header('Content-Disposition: attachment; filename="' . $aInfo['medUri'] . '.' . $sExt . '";');
                readfile($sPathFull);
                exit;
            } else {
                $this->_oTemplate->displayPageNotFound();
            }

        } elseif (!$aInfo) {
            $this->_oTemplate->displayPageNotFound();
        } else {
            $this->_oTemplate->displayAccessDenied();
        }
    }

    function getMultiUpload($oUploader)
    {
        return $oUploader->servicePerformMultiVideoUpload();
    }

    function serviceGetProfileCat ()
    {
        return PROFILE_VIDEO_CATEGORY;
    }

    function serviceGetMemberMenuItem ()
    {
        return parent::serviceGetMemberMenuItem ('film');
    }

    function serviceGetMemberMenuItemAddContent ()
    {
        return parent::serviceGetMemberMenuItemAddContent ('film');
    }

    function getEmbedCode ($iFileId, $aExtra = array())
    {
        return $this->_oTemplate->getEmbedCode($iFileId, $aExtra);
    }

	function isAllowedShare(&$aDataEntry)
    {
    	if($aDataEntry['AllowAlbumView'] != BX_DOL_PG_ALL)
    		return false;

        return true;
    }
    
    function isAllowedDownload (&$aFile, $isPerformAction = false)
    {
        if (getSettingValue('video', "save") != TRUE_VAL)
            return false;
        return $this->isAllowedView($aFile, $isPerformAction);
    }
}
