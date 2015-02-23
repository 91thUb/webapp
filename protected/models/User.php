<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $user_name
 * @property string $user_passwd
 * @property string $email
 * @property string $register_date
 * @property integer $register_by
 * @property integer $user_level_id
 * @property string $last_login_date
 * @property string $last_ip_address
 *
 * The followings are the available model relations:
 * @property UserLevel $userLevel
 */
class User extends MyModel
{

    public $changePassword = null;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, user_name, user_level_id', 'required'),
            array('user_passwd', 'required', 'on'=> 'New'),
            array('id, name, user_name, user_passwd, email, register_date, register_by, user_level_id, last_login_date, last_ip_address', 'safe', 'on' => 'search'),
            array('email', 'email'),
            array('user_name', 'unique', 'message' => 'Choose another name! This username ({value}) already taken'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userLevel' => array(self::BELONGS_TO, 'UserLevel', 'user_level_id'),
            'selfRelation' => array(self::BELONGS_TO, 'User', 'register_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'user_name' => 'Username',
            'user_passwd' => 'Password',
            'email' => 'Email',
            'register_date' => 'Register Date',
            'register_by' => 'Register by',
            'user_level_id' => 'User Level',
            'last_login_date' => 'Last Login Date',
            'last_ip_address' => 'Last Ip Address',
            'userLevel.name' => 'User Level',
            'selfRelation.name' => 'Register by',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_passwd', $this->user_passwd, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('register_date', $this->register_date, true);
        $criteria->compare('register_by', $this->register_by);
        $criteria->compare('user_level_id', $this->user_level_id);
        $criteria->compare('last_login_date', $this->last_login_date, true);
        $criteria->compare('last_ip_address', $this->last_ip_address, true);
        
        $criteria->order = 'user_level_id, name asc';

        return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pagesize' => 8,
                ),
            ));
    }

    public function beforeSave()
    {
        if($this->isNewRecord)
        {
            $this->register_date = new CDbExpression('NOW()');
            $this->user_passwd = md5($this->user_passwd);
        }
        
        if($this->changePassword != null)
        {
            $this->user_passwd = md5($this->changePassword);
        }
        
        return true;
    }

    public function validationBeforeDelete()
    {
        return true;
    }

}