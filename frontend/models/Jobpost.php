<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jobpost".
 *
 * @property int $ixJobPost
 * @property int $user_id
 * @property string $sSource
 * @property string $sLocation
 * @property string $sGeneralStartDate
 * @property string $sSalaryDescription
 * @property string $sRequirements
 * @property string $sBenefits
 * @property string $sDescription
 * @property string $sTitle
 * @property string $sEmployerName
 * @property string $sContactEmail
 * @property string $sUrl
 * @property string $sUrlExternal
 * @property string $sApplicationUrl
 * @property string $dtPosted
 * @property string $dtExpire
 * @property string $sAddress
 * @property string $sStateProvince
 * @property string $sCity
 * @property string $ixCountry
 * @property int $fVerified
 * @property int $fActive
 */
class Jobpost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobpost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'fVerified', 'fActive'], 'integer'],
            [['sSalaryDescription', 'sRequirements', 'sDescription'], 'string'],
            [['dtPosted', 'dtExpire'], 'required'],
            [['dtPosted', 'dtExpire'], 'safe'],
            [['sSource'], 'string', 'max' => 50],
            [['sLocation', 'sGeneralStartDate', 'sBenefits', 'sTitle', 'sEmployerName', 'sUrl', 'sUrlExternal', 'sApplicationUrl', 'sAddress'], 'string', 'max' => 255],
            [['sContactEmail', 'sStateProvince', 'sCity'], 'string', 'max' => 100],
            [['ixCountry'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ixJobPost' => 'Ix Job Post',
            'user_id' => 'User ID',
            'sSource' => 'S Source',
            'sLocation' => 'S Location',
            'sGeneralStartDate' => 'S General Start Date',
            'sSalaryDescription' => 'S Salary Description',
            'sRequirements' => 'S Requirements',
            'sBenefits' => 'S Benefits',
            'sDescription' => 'S Description',
            'sTitle' => 'S Title',
            'sEmployerName' => 'S Employer Name',
            'sContactEmail' => 'S Contact Email',
            'sUrl' => 'S Url',
            'sUrlExternal' => 'S Url External',
            'sApplicationUrl' => 'S Application Url',
            'dtPosted' => 'Dt Posted',
            'dtExpire' => 'Dt Expire',
            'sAddress' => 'S Address',
            'sStateProvince' => 'S State Province',
            'sCity' => 'S City',
            'ixCountry' => 'Ix Country',
            'fVerified' => 'F Verified',
            'fActive' => 'F Active',
        ];
    }
}
