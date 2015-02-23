<?php

/**
 * This is the model class for table "user_level".
 *
 * The followings are the available columns in table 'user_level':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $parent
 *
 * The followings are the available model relations:
 * @property ModulePrivilage[] $modulePrivilages
 * @property User[] $users
 */
class UserLevel extends MyModel
{
    
    public $onDeleteMessage;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserLevel the static model class
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
        return 'user_level';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//			array('parent', 'numerical', 'integerOnly'=>true),
//			array('name, description', 'length', 'max'=>50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, description, parent', 'required'),
            array('id, name, description, parent', 'safe', 'on' => 'search'),
            array('name', 'unique', 'message' => 'Choose another name! This level name ({value}) already taken'),
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
            'modulePrivilages' => array(self::HAS_MANY, 'ModulePrivilage', 'user_level_id'),
            'users' => array(self::HAS_MANY, 'User', 'user_level_id'),
            'selfRelation' => array(self::BELONGS_TO, 'UserLevel', 'parent'),
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
            'description' => 'Description',
            'parent' => 'Parent',
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
        $criteria->compare('description', $this->description, true);
        $criteria->compare('parent', $this->parent);
        
        $criteria->order = 'parent, name asc';

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pagesize' => 20,
                    )
                ));
    }

    public function scopes()
    {
        return array(
            'parentModule' => array(
                'condition' => 'parent = 0',
                'order' => 'name'
            ),
        );
    }

    public function validationBeforeDelete()
    {
        $usedInModule = array();
        $this->onDeleteMessage = 'Cannot delete "'. $this->name . '", data already used in (';

        $criteria = new CDbCriteria();
        $criteria->compare('parent', $this->id);

        $models = UserLevel::model()->findAll($criteria);

        if (isset($this->modulePrivilages) && count($this->modulePrivilages) > 0)
        {
            $usedInModule[] = 'Module';
        }

        if (isset($this->users) && count($this->users) > 0)
        {
            $usedInModule[] = 'User';
        }
        
        if(count($models) > 0)
        {
            $usedInModule[] = 'User Level';
        }
        
        if(count($usedInModule) > 0)
        {
            sort($usedInModule);
            foreach ($usedInModule as $value)
            {
                $this->onDeleteMessage .= $value .', ';
            }
            
            $this->onDeleteMessage = substr($this->onDeleteMessage, 0, strlen($this->onDeleteMessage) - 2);
            $this->onDeleteMessage .= '). Please delete related data first before delete it!';
            
            
            return false;
        }
        else
        {
            return true;
        }
    }
}