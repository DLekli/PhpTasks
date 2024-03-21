<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "prospect".
 *
 * @property int $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string|null $date
 * @property string|null $address
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $phone
 * @property string|null $fiscal_code
 */
class Prospect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prospect';
    }
    public $csvFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'first_name', 'last_name'], 'required'],
            [['date'], 'safe'],
            [['email', 'address'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'city'], 'string', 'max' => 100],
            [['zip', 'phone'], 'string', 'max' => 20],
            [['fiscal_code'], 'string', 'max' => 50],
            [['csvFile'], 'file', 'extensions' => 'csv'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'date' => 'Date',
            'address' => 'Address',
            'city' => 'City',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'fiscal_code' => 'Fiscal Code',
        ];
    }
}
