<?php

namespace app\models;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 *
 * @property Article[] $articles
 */class User extends \yii\db\ActiveRecord implements IdentityInterface 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'firstname', 'lastname', 'email', 'password'], 'required'],
            [['username', 'firstname', 'lastname', 'email', 'password'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['author' => 'id']);
    }

/**
 * {@inheritdoc}
 */
public static function findIdentity($id)
{
   // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
   return static::findOne($id);
}

/**
 * {@inheritdoc}
 */
public static function findIdentityByAccessToken($token, $type = null)
{

}

/**
 * Finds user by username
 *
 * @param string $username
 * @return static|null
 */
public static function findByUsername($username)
{
    return static::findOne(['username' =>$username]);
}

/**
 * {@inheritdoc}
 */
public function getId()
{
    return $this->id;
}

/**
 * {@inheritdoc}
 */
public function getAuthKey()
{
    //return $this->authKey;
}

/**
 * {@inheritdoc}
 */
public function validateAuthKey($authKey)
{
    return $this->authKey === $authKey;
}

/**
 * Validates password
 *
 * @param string $password password to validate
 * @return bool if password provided is valid for current user
 */
public function validatePassword($password)
{

        //return $this->password === $password;
       return Yii::$app->security->validatePassword($password, $this->password);
 
}

 //function for generating hashed password for the entered password
public function setPassword($password)
{
     $this->password = Yii::$app->security->generatePasswordHash($password); //<!-- to hide the password -->
}
}
