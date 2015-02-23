<?php

/**
 * This is the model class for table "module".
 *
 * The followings are the available columns in table 'module':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $url
 * @property integer $parent
 *
 * The followings are the available model relations:
 * @property ModulePrivilage[] $modulePrivilages
 */
class Module extends MyModel
{

    public $onDeleteMessage;
    public $hasPrivilage = false;
    public $arrPrivilages;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Module the static model class
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
        return 'module';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user isnputs.
        return array(
//            array('parent', 'numerical', 'integerOnly' => true),
//            array('name, description, url', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, description, url, parent', 'required'),
            array('hasPrivilage', 'required', 'message' => 'Modul must assign at least to one User Level'),
            array('id, name, description, url, parent', 'safe', 'on' => 'search'),
            array('hasPrivilage', 'boolean'),
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
            'privilages' => array(self::HAS_MANY, 'ModulePrivilage', 'module_id'),
            'selfRelation' => array(self::BELONGS_TO, 'Module', 'parent'),
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
            'url' => 'Modul URL Location',
            'parent' => 'Parent',
            'hasPrivilage' => 'Privilages'
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
        $criteria->compare('url', $this->url, true);
        $criteria->compare('parent', $this->parent);
        
        $criteria->order = 'parent, name asc';

        return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pagesize' => 30,
                ),
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

    public function afterSave()
    {
        if (count($this->arrPrivilages) && $this->parent != 0)
        {
            foreach ($this->arrPrivilages as $key)
            {
                $modulePrivilage = new ModulePrivilage();
                $modulePrivilage->module_id = $this->id;
                $modulePrivilage->user_level_id = $key;
                $modulePrivilage->save();
            }
        }
    }

    public function beforeSave()
    {
        if (!$this->isNewRecord && (count($this->privilages) > 0 || $this->parent == 0))
        {
            foreach ($this->privilages as $modulePrivilage)
            {
                $modulePrivilage->delete();
            }
        }
        return true;
    }

    public function validationBeforeDelete()
    {
        $usedInModule = array();
        $this->onDeleteMessage = 'Cannot delete "' . $this->name . '", data already used in (';

        $criteria = new CDbCriteria();
        $criteria->compare('parent', $this->id);

        $models = Module::model()->findAll($criteria);

        if (isset($this->modulePrivilages) && count($this->modulePrivilages) > 0)
        {
            $usedInModule[] = 'Module';
        }

        if (count($models) > 0)
        {
            $usedInModule[] = 'Module';
        }

        if (count($usedInModule) > 0)
        {
            sort($usedInModule);
            foreach ($usedInModule as $value)
            {
                $this->onDeleteMessage .= $value . ', ';
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

    public function __toString()
    {
        return $this->id;
    }

}