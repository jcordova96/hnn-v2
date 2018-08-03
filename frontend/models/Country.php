<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $ixCountry
 * @property string $sName
 * @property string $sFormattedName
 * @property string $ixCountry2
 * @property int $sIsoNumCode
 * @property string $sRegion
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sName', 'sFormattedName'], 'required'],
            [['sIsoNumCode'], 'integer'],
            [['sName', 'sFormattedName'], 'string', 'max' => 80],
            [['ixCountry2'], 'string', 'max' => 3],
            [['sRegion'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ixCountry' => 'Ix Country',
            'sName' => 'S Name',
            'sFormattedName' => 'S Formatted Name',
            'ixCountry2' => 'Ix Country2',
            'sIsoNumCode' => 'S Iso Num Code',
            'sRegion' => 'S Region',
        ];
    }
}
