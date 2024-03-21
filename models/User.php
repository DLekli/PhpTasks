<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class User extends  ActiveRecord implements IdentityInterface
{
    // public $id;
    // public $username;
    public $password;
    public $passwordhash;
    
    public $auth_key;
    public $access_token;

    // private static $users = [
    //     '100' => [
    //         'id' => '100',
    //         'username' => 'admin',
    //         'password' => 'admin',
    //         'authKey' => 'test100key',
    //         'accessToken' => '100-token',
    //     ],
    //     '101' => [
    //         'id' => '101',
    //         'username' => 'demo',
    //         'password' => 'demo',
    //         'authKey' => 'test101key',
    //         'accessToken' => '101-token',
    //     ],
    // ];


    // /**
    //  * {@inheritdoc}
    //  */
    // public static function findIdentity($id)
    // {
    //     return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public static function findIdentityByAccessToken($token, $type = null)
    // {
    //     foreach (self::$users as $user) {
    //         if ($user['accessToken'] === $token) {
    //             return new static($user);
    //         }
    //     }

    //     return null;
    // }

    // /**
    //  * Finds user by username
    //  *
    //  * @param string $username
    //  * @return static|null
    //  */
    // public static function findByUsername($username)
    // {
    //     foreach (self::$users as $user) {
    //         if (strcasecmp($user['username'], $username) === 0) {
    //             return new static($user);
    //         }
    //     }

    //     return null;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getId()
    // {
    //     return $this->id;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getAuthKey()
    // {
    //     return $this->authKey;
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function validateAuthKey($authKey)
    // {
    //     return $this->authKey === $authKey;
    // }

    // /**
    //  * Validates password
    //  *
    //  * @param string $password password to validate
    //  * @return bool if password provided is valid for current user
    //  */
    // public function validatePassword($password)
    // {
    //     return $this->password === $password;
    // }

    public static function tableName()
    {
        return 'user';
    }
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;
    // public $role;
    // public $password_hash;


    // public $id;
    // public $username;
    // public $password;
    // public $password_hash;
    // public $auth_key;
    // public $access_token;

   public function rules()
    {
        return [
            [['username', 'password', 'role'], 'required'],
            [['username', 'password', 'authKey', 'accessToken', 'role', 'password_hash'], 'safe'],
        ];
    }


    // public function rules()
    // {
    //     return [
    //         [['username'], 'required'],
    //         [['username'], 'string', 'max' => 255],
    //         [['password'], 'required', 'on' => 'create'],
    //         [['password'], 'string', 'min' => 6, 'on' => 'create'],
    //         [['password'], 'safe', 'on' => 'update'],
    //         [['password_hash', 'auth_key', 'access_token'], 'safe'],
    //     ];
    // }

    // public function rules()
    // {
    //     return [
    //         [['username', 'password'], 'required'],
    //         [['username'], 'string', 'max' => 255],
    //         [['password'], 'string', 'min' => 6],
    //         [['password'], 'safe', 'on' => 'update'],
    //         [['password_hash', 'auth_key', 'access_token'], 'safe'],
    //     ];
    // }



    

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'role' => 'Role',
            'password_hash' => 'Password Hash',
        ];
    }

    /*public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                // Generate authKey and accessToken for new records
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->access_token = Yii::$app->security->generateRandomString();
            }

            // Hash the password if it is set and not empty
            if (!empty($this->password)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
                // Clear the plain password
                $this->password = '';
            }

            return true;
        }
        return false;
    }*/

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                // Generate authKey and accessToken for new records
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->access_token = Yii::$app->security->generateRandomString();
            }

            // Hash the password if it is set and not empty
            if (!empty($this->password)) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            }

            return true;
        }
        return false;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    // public function validatePassword($password)
    // {
    //     // Replace this with Yii2's built-in password hashing mechanism
    //     return $this->password === md5($password);
    // }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
