<?php

class CustomController extends CController
{
    // default layout decorator for backend
    public $layout = 'main';
    
    // side bar menu 
    public $accessibleModules = array();
    
    // default menu
    public $menu = array();
	
    // default breadcumb
	public $breadcrumbs = array();
        
    public function init()
    {
        parent::init();
        $this->accessibleModules = $this->getAccessibleModule();
    }

    public function getAccessibleModule()
    {
        if (Yii::app()->user->isGuest)
            return;

        $criteria = new CDbCriteria();
        $criteria->compare('user_level_id', Yii::app()->user->userLevel);
        
        $modulePrivilages = ModulePrivilage::model()->findAll($criteria);
        $result = array();
        
        foreach ($modulePrivilages as $modulePrivilage)
        {
            $result[] = $modulePrivilage->module;
            if(!in_array($modulePrivilage->module->parent, $modulePrivilages))
            {
                $moduleCriteria = new CDbCriteria();
                $moduleCriteria->compare('id', $modulePrivilage->module->parent);
                $module = Module::model()->find($moduleCriteria);
                
                $result[] = $module;
            }
        }
        
        $result = array_unique($result);
        
        return $result;
    }
}

?>
