<?php

namespace app\components;

use Yii;

/**
 * User: dataskills dataskills@gmail.com
 * Date: 6/3/14
 * Time: 11:21 AM
 */
class Toolshed
{

    public static function getDisplayDate($date_string, $format = 'M jS Y')
    {
        return date($format, strtotime($date_string));
    }

    public static function userHasRole($sRole, $sUsername)
    {
        $rAuthManager = Yii::app()->authManager;
        $aUserAssignments = $rAuthManager->getAuthAssignMents($sUsername);

        $roles = array();
        foreach ($aUserAssignments as $sRoleName => $oCAuthItem)
        {
            $roles[] = $sRoleName;
        }

        $result = in_array($sRole, $roles);
        return $result;
    }

    public static function getImage($html)
    {
        $result = null;

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_use_internal_errors(false);

        $images = $dom->getElementsByTagName("img");

        foreach ($images as $image)
        {
            if ($image->hasAttributes())
            {
                foreach ($image->attributes as $attr)
                {
                    if ($attr->nodeName == 'src')
                    {
                        $result = trim($attr->nodeValue);
                        break;
                    }
                }
            }
        }

        return $result;
    }
} 