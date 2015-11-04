<?php

/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

bx_import('BxDolPermalinks');
bx_import('BxTemplFormView');
bx_import('BxDolUserStatusView');
bx_import('BxDolModule');

class BxBaseFunctions
{
    var	$aSpecialKeys;

    function BxBaseFunctions()
    {
        $this -> aSpecialKeys = array('rate' => '', 'rate_cnt' => '');
    }

    function getProfileMatch( $memberID, $profileID )
    {
        $match_n = getProfilesMatch($memberID, $profileID); // impl
        return DesignProgressPos ( _t("_XX match", $match_n), $GLOBALS['oTemplConfig']->iProfileViewProgressBar, 100, $match_n );;
    }

    function getProfileZodiac( $profileDate )
    {
        return ShowZodiacSign( $profileDate );
    }

    function TemplPageAddComponent($sKey)
    {
        switch( $sKey ) {
            case 'something':
                return false; // return here additional components
            default:
                return false; // if you have not such component, return false!
        }
    }

    /**
    * Function will generate object's action link ;
    *
    * @param  		: $aObjectParamaters (array) contain special markers ;
    * @param  		: $aRow (array) links's info ;
    * @param  		: $sCssClass (string) additional css style ;
    * @return 		: Html presentation data ;
    */
    function genActionLink( &$aObjectParamaters, $aRow, $sCssClass = null, $sTemplateIndexActionLink = 'action')
    {
        // ** init some needed variables ;
        $sOutputHtml = null;

        $aUsedTemplate = array (
            'action' => 'action_link.html',
            'action_symbol' => 'action_link_symbol.html',
            'action_submenu' => 'action_link_submenu.html',
            'action_submenu_symbol' => 'action_link_submenu_symbol.html',
        );

        // find and replace all special markers ;
        foreach( $aRow AS $sKeyName => $sKeyValue ) {
            if ( $sKeyName == 'Caption' ) {
                $aRow[$sKeyName] =  $this -> markerReplace($aObjectParamaters, $sKeyValue, $aRow['Eval'], true);
            } else {
                $aRow[$sKeyName] =  $this -> markerReplace($aObjectParamaters, $sKeyValue, $aRow['Eval']);
            }
        }

        $sKeyValue = trim($sKeyValue, '{}');

        if ( array_key_exists($sKeyValue, $this -> aSpecialKeys) ) {
            return $aRow['Eval'];
        } else {
            $sSiteUrl = (preg_match("/^(http|https|ftp|mailto)/", $aRow['Url'])) ? '' : BX_DOL_URL_ROOT;
            // build the link components ;
            //$sLinkSrc = (!$aRow['Script']) ? $aRow['Url'] : 'javascript:void(0)';

            $sScriptAction = ( $aRow['Script'] ) ? ' onclick="' . $aRow['Script'] . '"' : '';
            $sScriptAction = ($sScriptAction=='' && $aRow['Url']!='') ? " onclick=\"window.open ('{$sSiteUrl}{$aRow['Url']}','_self');\" " : $sScriptAction;

            if (false === strpos($aRow['Icon'], '.')) {
                $sIcon = $aRow['Icon'];
                $sTmpl = $sTemplateIndexActionLink . '_symbol';
            } else {
                $sIcon = getTemplateIcon($aRow['Icon']);
                $sTmpl = $sTemplateIndexActionLink;
            }

            if ( $aRow['Caption'] and ($aRow['Url'] or $aRow['Script'] ) ) {

                $sCssClass = ( $sCssClass ) ? 'class="' . $sCssClass . '"' :  null;

                $aTemplateKeys = array (
                    'action_img_alt'	=> $aRow['Caption'],
                    'action_img_src'	=> $sIcon,
                    'action_caption'	=> $aRow['Caption'],
                    'extended_css'		=> $sCssClass,
                    'extended_action'	=> $sScriptAction,
                );

                $sOutputHtml .= $GLOBALS['oSysTemplate'] -> parseHtmlByName( $aUsedTemplate[$sTmpl], $aTemplateKeys );
            }
        }

        return $sOutputHtml;
    }

    /**
     * Function will parse and replace all special markers ;
     *
     * @param $aMemberSettings (array) : all available member's information
     * @param $sTransformText (text) : string that will to parse
     * @param $bTranslate (boolean) : if isset this param - script will try to translate it used dolphin language file
     * @return (string) : parsed string
    */
    function markerReplace( &$aMemberSettings, $sTransformText, $sExecuteCode = null, $bTranslate = false )
    {
        $aMatches = array();
        preg_match_all( "/([a-z0-9\-\_ ]{1,})|({([^\}]+)\})/i", $sTransformText, $aMatches );
        if ( is_array($aMatches) and !empty($aMatches) ) {
            // replace all founded markers ;
            foreach( $aMatches[3] as $iMarker => $sMarkerValue ) {
                if ( is_array($aMemberSettings) and array_key_exists($sMarkerValue, $aMemberSettings) and !array_key_exists($sMarkerValue, $this -> aSpecialKeys) ){
                    $sTransformText = str_replace( '{' . $sMarkerValue . '}', $aMemberSettings[$sMarkerValue],  $sTransformText);
                } else if ( $sMarkerValue == 'evalResult' and $sExecuteCode ) {
                    //find all special markers into Execute code ;
                    $sExecuteCode = $this -> markerReplace( $aMemberSettings, $sExecuteCode );
                    $sTransformText =  str_replace( '{' . $sMarkerValue . '}', eval( $sExecuteCode ),  $sTransformText);
                } else {
                    //  if isset into special keys ;
                    if ( array_key_exists($sMarkerValue, $this -> aSpecialKeys) ) {
                        return $aMemberSettings[$sMarkerValue];
                    } else {
                        // undefined keys
                        switch ($sMarkerValue) {
                        }
                    }
                }
            }

            // try to translate item ;
            if ( $bTranslate ) {
                foreach( $aMatches[1] as $iMarker => $sMarkerValue ) if ( $sMarkerValue )
                    $sTransformText = str_replace( $sMarkerValue , _t( trim($sMarkerValue) ),  $sTransformText);
            }
        }

        return $sTransformText;
    }

    function msgBox($sText, $iTimer = 0, $sOnTimer = "")
    {
        $iId = mktime() . mt_rand(1, 1000);

        return $GLOBALS['oSysTemplate']->parseHtmlByName('messageBox.html', array(
            'id' => $iId,
            'msgText' => $sText,
            'bx_if:timer' => array(
                'condition' => $iTimer > 0,
                'content' => array(
                    'id' => $iId,
                    'time' => 1000 * $iTimer,
                    'on_timer' => bx_js_string($sOnTimer, BX_ESCAPE_STR_QUOTE),
                )
            )
        ));
    }

    function loadingBox($sName)
    {
        return $GLOBALS['oSysTemplate']->parseHtmlByName('loading.html', array(
            'name' => $sName,
        ));
    }

    /**
     * Get standard popup box.
     *
     * @param  string $sTitle   - translated title
     * @param  string $sContent - content of the box
     * @param  array  $aActions - an array of actions. See an example below.
     * @return string HTML of Standard Popup Box
     *
     * @see Example of actions
     *      $aActions = array(
     *          'a1' => array('href' => 'javascript:void(0)', 'onclick' => 'javascript: changeType(this)', 'class' => 'wall-ptype-ctl', 'icon' => 'post_text.png', 'title' => _t('_title_a1'), 'active' => 1),
     *          'a2' => array('href' => 'javascript:void(0)', 'onclick' => 'javascript: changeType(this)', 'class' => 'wall-ptype-ctl', 'icon' => 'post_text.png', 'title' => _t('_title_a2'))
     *      );
     */
    function popupBox($sName, $sTitle, $sContent, $aActions = array())
    {
        $iId = !empty($sName) ? $sName : mktime();

        $aButtons = array();
        foreach($aActions as $sId => $aAction)
            $aButtons[] = array(
                'id' => $sId,
                'title' => htmlspecialchars_adv(_t($aAction['title'])),
                'class' => isset($aAction['class']) ? ' class="' . $aAction['class'] . '"' : '',
                'icon' => isset($aAction['icon']) ? '<img src="' . $aAction['icon'] . '" />' : '',
                'href' => isset($aAction['href']) ? ' href="' . htmlspecialchars_adv($aAction['href']) . '"' : '',
                'target' => isset($aAction['target'])  ? ' target="' . $aAction['target'] . '"' : '',
                'on_click' => isset($aAction['onclick']) ? ' onclick="' . $aAction['onclick'] . '"' : '',
                'bx_if:hide_active' => array(
                    'condition' => !isset($aAction['active']) || $aAction['active'] != 1,
                    'content' => array()
                ),
                'bx_if:hide_inactive' => array(
                    'condition' => isset($aAction['active']) && $aAction['active'] == 1,
                    'content' => array()
                )
            );

        return $GLOBALS['oSysTemplate']->parseHtmlByName('popup_box.html', array(
            'id' => $iId,
            'title' => $sTitle,
            'bx_repeat:actions' => $aButtons,
            'content' => $sContent
        ));
    }

    function transBox($content, $isPlaceInCenter = false)
    {
        return
            ($isPlaceInCenter ? '<div class="login_ajax_wrap">' : '') .
                $GLOBALS['oSysTemplate']->parseHtmlByName('transBox.html', array('content' => $content)) .
            ($isPlaceInCenter ? '</div>' : '');
    }

    /**
    * @description : function will generate the sex icon ;
    * @param 		: $sSex (string) - sex name ;
    * @return 		: (text) - path to image ;
    */
    function genSexIcon($sSex)
    {
        switch( $sSex ) {
            case 'male'	:
                return getTemplateIcon( 'male.png' );
            case 'female' :
                return getTemplateIcon( 'female.png' );
            case 'men'	:
                return getTemplateIcon( 'male.png' );
            default :
                return getTemplateIcon( 'tux.png' );
        }
    }

    function getSexPic($sSex, $sType = 'medium')
    {
        $aGenders = array (
            'female' => 'woman_',
            'Female' => 'woman_',
            'male' => 'man_',
            'Male' => 'man_',
        );
        return getTemplateIcon(isset($aGenders[$sSex]) ? $aGenders[$sSex] . $sType . '.gif' : 'visitor_' . $sType . '.gif');
    }

    function getMemberAvatar($iId, $sType = 'medium')
    {
        $aProfile = getProfileInfo($iId);

        bx_import('BxDolMemberInfo');
        $o = BxDolMemberInfo::getObjectInstance(getParam($sType == 'small' ? 'sys_member_info_thumb_icon' : 'sys_member_info_thumb'));
        return $o ? $o->get($aProfile) : '';
    }

    function getMemberThumbnail($iId, $sFloat = 'none', $bGenProfLink = false, $sForceSex = 'visitor', $isAutoCouple = true, $sType = 'medium', $aOnline = array())
    {
        $aProfile = getProfileInfo($iId);
        if (!$aProfile)
            return '';

        $bCouple = ((int)$aProfile['Couple'] > 0) && $isAutoCouple ? true : false;

        $bOnline = 0;

        bx_import('BxDolMemberInfo');
        $o = BxDolMemberInfo::getObjectInstance(getParam($sType == 'small' ? 'sys_member_info_thumb_icon' : 'sys_member_info_thumb'));
        $sThumbUrl = $o ? $o->get($aProfile) : '';
        if (!$sThumbUrl)
            return '';

        $sLink = '';
        $sUserTitle = '';
        $sUserInfo = '';

        $oUserStatusView = bx_instance('BxDolUserStatusView');
        $sStatusIcon = $oUserStatusView->getStatusIcon($iId, 'icon8');

        if ($iId > 0) {
            $sLink = getProfileLink($iId);
            $sUserTitle = $this->getUserTitle($iId);
            $sUserInfo = $this->getUserInfo($iId);

            if (empty($aOnline) || 0 != (int)$aOnline['is_online'])
                $bOnline = 1;
        }

        if (!$bGenProfLink) {
            if ($sForceSex != 'visitor') {
                $sUserTitle = _t('_Vacant');
                $sLink = 'javascript:void(0)';
            }
        }

        $aVariables = array(
            'iProfId' => $iId ? $iId : 0,
            'sys_thb_float' => $sFloat,
            'classes_add' => ($bGenProfLink ? ' thumbnail_block_with_info' : '') . ($sType != 'medium' ? ' thumbnail_block_icon' : ''),
            'sys_status_icon' => $sStatusIcon,
            'sys_status_title' => $oUserStatusView->getStatus($iId),
            'usr_profile_url' => $sLink,
            'usr_thumb_url0' => $sThumbUrl,
            'usr_thumb_title0' => $sUserTitle,
            'bx_if:profileLink' => array(
                'condition' => $bGenProfLink,
                'content' => array(
                    'user_title' => $sUserTitle,
                    'user_info' => $sUserInfo,
                    'usr_profile_url' => $sLink,
                ),
            ),
        );

        if ($bCouple) {
            $aProfileCouple = getProfileInfo($aProfile['Couple']);
            $aVariables['usr_thumb_url1'] = $aProfileCouple['Avatar'] ? BX_AVA_URL_USER_AVATARS . $aProfileCouple['Avatar'] . ($sType == 'small' ? 'i' : '') . BX_AVA_EXT : $this->getSexPic($aProfileCouple['Sex'], $sType);
        }

        return $GLOBALS['oSysTemplate']->parseHtmlByName($bCouple ? "thumbnail_couple.html" : "thumbnail_single.html", $aVariables);
    }

    function getMemberIcon($iId, $sFloat = 'none', $bGenProfLink = false)
    {
        return $this->getMemberThumbnail($iId, $sFloat, $bGenProfLink, 'visitor', false, 'small');
    }

    /**
     * Get image of the specified type by image id
     * @param $aImageInfo image info array with the following info
     *          $aImageInfo['Avatar'] - photo id, NOTE: it not relatyed to profiles avataras module at all
     * @param $sImgType image type
     */
    function _getImageShared($aImageInfo, $sType = 'thumb')
    {
        return BxDolService::call('photos', 'get_image', array($aImageInfo, $sType), 'Search');
    }

    function getTemplateIcon($sName)
    {
        $sUrl = $GLOBALS['oSysTemplate']->getIconUrl($sName);
        return !empty($sUrl) ? $sUrl : $GLOBALS['oSysTemplate']->getIconUrl('spacer.gif');
    }

    function getTemplateImage($sName)
    {
        $sUrl = $GLOBALS['oSysTemplate']->getImageUrl($sName);
        return !empty($sUrl) ? $sUrl : $GLOBALS['oSysTemplate']->getImageUrl('spacer.gif');
    }

    /**
     * @description : function will generate object's action lists;
     * @param : $aKeys        (array)  - array with all nedded keys;
     * @param : $sActionsType (string) - type of actions;
     * @param : $iDivider     (integer) - number of column;
     * @return:  HTML presentation data;
    */
    function genObjectsActions( &$aKeys,  $sActionsType, $bSubMenuMode = false, $sTemplateIndex = 'actions', $sTemplateIndexActionLink = 'action' )
    {
        // ** init some needed variables ;
        $sActionsList 	= null;
        $sResponceBlock = null;

        $aUsedTemplate	= array (
            'actions_submenu' => 'member_actions_list_submenu.html',
            'actions' => 'member_actions_list.html',
            'ajaxy_popup' => 'ajaxy_popup_result.html',
        );

        // read data from cache file ;
        $oCache = $GLOBALS['MySQL']->getDbCacheObject();
        $aActions = $oCache->getData($GLOBALS['MySQL']->genDbCacheKey('sys_objects_actions'));

        // if cache file empty - will read from db ;
        if (null === $aActions || empty($aActions[$sActionsType]) ) {

            $sQuery  = 	"
                SELECT
                    `Caption`, `Icon`, `Url`, `Script`, `Eval`, `bDisplayInSubMenuHeader`
                FROM
                    `sys_objects_actions`
                WHERE
                    `Type` = '{$sActionsType}'
                ORDER BY
                    `Order`
            ";

            $rResult = db_res($sQuery);
            while ( $aRow = mysql_fetch_assoc($rResult) ) {
                $aActions[$sActionsType][] = $aRow;
            }

            // write data into cache file ;
            if ( is_array($aActions[$sActionsType]) and !empty($aActions[$sActionsType]) ) {
                $oCache->setData ($GLOBALS['MySQL']->genDbCacheKey('sys_objects_actions'), $aActions);
            }
        }

        // ** generate actions block ;

        // contain all systems actions that will procces by self function ;
        $aCustomActions = array();
        if ( is_array($aActions[$sActionsType]) and !empty($aActions[$sActionsType]) ) {

            // need for table's divider ;
            $iDivider = $iIndex = 0;
            foreach( $aActions[$sActionsType] as  $aRow ) {
                if ($bSubMenuMode && $aRow['bDisplayInSubMenuHeader']==0) continue;

                $sOpenTag = $sCloseTag = null;

                // generate action's link ;
                $sActionLink = $this -> genActionLink( $aKeys, $aRow, 'menuLink', $sTemplateIndexActionLink );

                if ( $sActionLink ) {
                    $iDivider = $iIndex % 2;

                    if ( !$iDivider ) {
                        $sOpenTag = '<tr>';
                    }

                    if ( $iDivider ) {
                        $sCloseTag = '</tr>';
                    }

                    $aActionsItem[] = array (
                        'open_tag'    => $sOpenTag,
                        'action_link' => $sActionLink,
                        'close_tag'   => $sCloseTag,
                    );

                    $iIndex++;
                }

                // it's system action ;
                if ( !$aRow['Url'] && !$aRow['Script'] ) {
                    $aCustomActions[] =  array (
                        'caption'   => $aRow['Caption'],
                        'code'      => $aRow['Eval'],
                    );
                }
            }
        }

        if ($iIndex % 2 == 1) { //fix for ODD menu elements count
            $aActionsItem[] = array (
                'open_tag'    => '',
                'action_link' => '',
                'close_tag'   => ''
            );
        }

        if ( !empty($aActionsItem) ) {

            // check what response window use ;
            // is there any value to having this template even if the ID is empty?
            if (!empty($aKeys['ID'])) {
                $sResponceBlock = $GLOBALS['oSysTemplate'] -> parseHtmlByName( $aUsedTemplate['ajaxy_popup'], array('object_id' => $aKeys['ID']) );
            }

            $aTemplateKeys = array (
                'bx_repeat:actions' => $aActionsItem,
                'responce_block'    => $sResponceBlock,
            );

            $sActionsList = $GLOBALS['oSysTemplate'] -> parseHtmlByName( $aUsedTemplate[$sTemplateIndex], $aTemplateKeys );
        }

        //procces all the custom actions ;
        if ($aCustomActions) {
            foreach($aCustomActions as $iIndex => $sValue ) {
                $sActionsList .= eval( $this -> markerReplace($aKeys, $aCustomActions[$iIndex]['code']) );
            }
        }

        return $sActionsList;
    }

    /**
     * alternative to GenFormWrap
     * easy to use but javascript based
     * $s - content to be centered
     * $sBlockStyle - block's style, jquery selector
     *
     * see also bx_center_content javascript function, if you need to call this function from javascript
     */
    function centerContent ($s, $sBlockStyle, $isClearBoth = true)
    {
        $sId = 'id' . time() . rand();
        return  '<div id="'.$sId.'">' . $s . ($isClearBoth ? '<div class="clear_both"></div>' : '') . '</div><script>
            $(document).ready(function() {
                var eCenter = $("#'.$sId.'");
                var iAll = $("#'.$sId.' '.$sBlockStyle.'").size();
                var iWidthUnit = $("#'.$sId.' '.$sBlockStyle.':first").outerWidth({"margin":true});
                var iWidthContainer = eCenter.width();
                var iPerRow = parseInt(iWidthContainer/iWidthUnit);
                var iLeft = (iWidthContainer - (iAll > iPerRow ? iPerRow * iWidthUnit : iAll * iWidthUnit)) / 2;
                eCenter.css("padding-left", iLeft);
            });
        </script>';
    }

    /**
     * Generates site's main logo.
     *
     * @return: HTML presentation data;
     */
    function genSiteLogo()
    {
        global $dir, $site;

        $sFileName = getParam('sys_main_logo');
        if (!$sFileName || !file_exists($dir['mediaImages'] . $sFileName))
            return '<a class="mainLogoText" href="' . BX_DOL_URL_ROOT . '">' . getParam('site_title') . '</a>';

        return '<a href="' . BX_DOL_URL_ROOT . '"><img src="' . $site['mediaImages'] . $sFileName . '" class="mainLogo" alt="logo" /></a>';
    }

    /**
     * Generates site's splash.
     *
     * @return: HTML presentation data;
     */
    function genSiteSplash()
    {
        $sVisibility = getParam('splash_visibility');
        $bLogged = getParam('splash_logged') == 'on';

        if($sVisibility == BX_DOL_SPLASH_VIS_DISABLE || ($sVisibility == BX_DOL_SPLASH_VIS_INDEX && !defined('BX_INDEX_PAGE')) || ($bLogged && isLogged()))
            return '';

        return DesignBoxContent('', getParam('splash_code'), 3);
    }

    /**
     * Function will generate site's search;
     *
     * @return : Html presentation data;
     */
    function genSiteSearch()
    {
        $sSearchC = process_line_output(_t('_Search...'));
        ob_start();
?>
<script language="javascript">
    $(document).ready( function() {
        $('#keyword').blur(function() {
                $('#keyword').removeClass('input_focus input_main');
                $('#keyword').addClass('input_main');
                if ('' == $('#keyword').val())
                    $('#keyword').val('<?= $sSearchC ?>');
            }
        );
        $('#keyword').focus(function() {
                $('#keyword').removeClass('input_focus input_main');
                $('#keyword').addClass('input_focus');
                if ('<?= $sSearchC ?>' == $('#keyword').val())
                    $('#keyword').val('');
            }
        );
    });
</script>
<!--<div id="sys_search_wrapper">
    <div id="sys_search" class="bx-def-margin-left bx-def-round-corners-with-border">
        <form action="searchKeyword.php" method="get" name="SearchForm">
           <div class="search_input"> 
           <input type="text" name="keyword" id="keyword"  placeholder="Search people here... " value="<?php //echo $sSearchC; ?>" class="input_main bx-def-font" />
           </div>
            <div class="search_btn"><button type="submit"><img src="http://studoro.com/templates/base/images/search_btn.png"></button></div>
        </form>
    </div>
</div>-->
<div class="clear_both"></div>
<?php

        return ob_get_clean();
    }

    /**
     * Function will generate site's service menu;
     *
     * @return : Html presentation data;
     */
    function genSiteServiceMenu()
    {
        bx_import('BxTemplMenuService');
        $oMenu = new BxTemplMenuService();
        return '<div class="sys-service-menu-wrp bx-def-margin-sec-right bx-def-padding-right">' . $oMenu->getCode() . '</div>';
    }

    /**
     * Function will generate site's bottom menu;
     *
     * @return : Html presentation data;
     */
    function genSiteBottomMenu()
    {
        bx_import('BxTemplMenuBottom');
        $oMenu = new BxTemplMenuBottom();
        return $oMenu->getCode();
    }

    function genNotifyMessage($sMessage, $sDirection = 'left', $isButton = false, $sScript = '')
    {
        $sDirStyle = ($sDirection == 'left') ? '' : 'notify_message_none';
        switch ($sDirection) {
            case 'none': break;
            case 'left': break;
        }

        $sPossibleID = ($isButton) ? ' id="isButton" ' : '';
        $sOnClick = $sScript ? ' onclick="' . $sScript . '"' : '';

        return <<<EOF
<div class="notify_message {$sDirStyle}" {$sPossibleID} {$sOnClick}>
    <table class="notify" cellpadding=0 cellspacing=0><tr><td>{$sMessage}</td></tr></table>
    <div class="notify_wrapper_close"> </div>
</div>
EOF;
    }

    function getSiteStatBody($aVal, $sMode = '')
    {
        $sLink = strlen($aVal['link']) > 0 ? '<a href="'.BX_DOL_URL_ROOT.$aVal['link'].'">{iNum} '._t('_'.$aVal['capt']).'</a>' : '{iNum} '._t('_'.$aVal['capt']) ;
        if ( $sMode != 'admin' ) {
            $sBlockId = '';
            $iNum = strlen($aVal['query']) > 0 ? db_value($aVal['query']) : 0;
        } else {
            $sBlockId = "id='{$aVal['name']}'";
            $iNum  = strlen($aVal['adm_query']) > 0 ? db_value($aVal['adm_query']) : 0;
            if ( strlen($aVal['adm_link']) > 0 ) {
                if( substr( $aVal['adm_link'], 0, strlen( 'javascript:' ) ) == 'javascript:' ) {
                    $sHref = 'javascript:void(0);';
                    $sOnclick = 'onclick="' . $aVal['adm_link'] . '"';
                } else {
                    $sHref = $aVal['adm_link'];
                    $sOnclick = '';
                }
                $sLink = '<a href="'.$sHref.'" '.$sOnclick.'>{iNum} '._t('_'.$aVal['capt']).'</a>';
            } else {
                $sLink = '{iNum} '._t('_'.$aVal['capt']);
            }
        }

        $sLink = str_replace('{iNum}', $iNum, $sLink);
        $sImg = (false === strpos($aVal['icon'], '.') ? '<i class="sys-icon ' . $aVal['icon'] . '"></i>' : '<img src="' . getTemplateIcon($aVal['icon']) . '" alt="" />');
        $sCode =
        '
            <div class="siteStatUnit" '. $sBlockId .'>
                ' . $sImg . $sLink . '
            </div>
        ';

        return $sCode;
    }

    function genGalleryImages($aImages, $oTemplate = false)
    {
        if (!$aImages)
            return '';

        $aVars = array (
            'prefix' => $sPrefix ? $sPrefix : 'id'.time().'_'.rand(1, 999999),
            'bx_repeat:images_icons' => array (),
            'bx_repeat:icons' => array (),
        );

        $iId = 0;
        foreach ($aImages as $aImage) {
            $a = array (
                'id' => ++$iId,
                'icon_url' => $aImage['icon_url'],
                'image_url' => $aImage['image_url'],
                'title' => $aImage['title'],
            );
            $aVars['bx_repeat:images'][] = $a;
            $aVars['bx_repeat:icons'][] = $a;
        }

        if (!$oTemplate)
            $oTemplate = $GLOBALS['oSysTemplate'];

        $oTemplate->addJs('jquery.dolGalleryImages.js');
        $oTemplate->addCss('gallery_images.css');
        return $oTemplate->parseHtmlByName('gallery_images.html', $aVars);
    }

    /**
     * Generate code for system icon, depending on $sImg name it returns vector or pixel icon.
     * Vector icon is determined by missing dot sign in the name.
     *
     * @param $sImg - system icon filename, full path to custom icon, or vector icon name
     * @param $sClassAdd - add these classes to the icon
     * @param $sAlt - alt text for pixel icon or title text for vector icon
     * @param $sAttr - custom attributes string
     * @param $sImageType - pixel image type to automatically get full path to the icon: icon, image or empty string
     *
     * @return ready to use HTML code with icon, it is <img ... /> - in case of pixel icon; <i class="sys-icon ..." ...></i> - in cace of vector icon
     */
    function sysImage($sImg, $sClassAdd = '', $sAlt = '', $sAttr = '', $sImageType = false, $iSize = 16)
    {
        if (!$sImg)
            return '';
        if ($sClassAdd)
            $sClassAdd = ' ' . $sClassAdd;

        if (false === strpos($sImg, '.')) // return vector icon
            return '<i class="sys-icon ' . $sImg . $sClassAdd . '" alt="' . bx_html_attribute($sAlt) . '" ' . $sAttr . '></i>';

        // return pixel icon
        switch ($sImageType) {
            case 'icon':
                $sImg = $this->getTemplateIcon($sImg);
            break;
            case 'image':
                $sImg = $this->getTemplateImage($sImg);
            break;
        }

        return '<img src="' . $sImg . '" class="' . $sClassAdd . '" alt="' . bx_html_attribute($sAlt) . '" ' . $sAttr . ' border="0" width="' . $iSize . '" height="' . $iSize . '" />';
    }



    function getUserTitle ($iId)
    {
        $aProfile = getProfileInfo($iId);
        if (!$aProfile)
            return false;

        bx_import('BxDolMemberInfo');
        $o = BxDolMemberInfo::getObjectInstance(getParam('sys_member_info_name'));
        return $o ? $o->get($aProfile) : $aProfile['NickName'];
    }

    function getUserInfo ($iId)
    {
        $aProfile = getProfileInfo($iId);
        if (!$aProfile)
            return false;

        bx_import('BxDolMemberInfo');
        $o = BxDolMemberInfo::getObjectInstance(getParam('sys_member_info_info'));
        return $o ? $o->get($aProfile) : '';
    }
}