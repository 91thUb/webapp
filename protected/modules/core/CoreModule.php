<?php

class CoreModule extends CWebModule
{
    private $_assetsUrl;
    public static $MODULE_NAME = 'core';
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
            self::$MODULE_NAME . '.models.*',
            self::$MODULE_NAME . '.forms.*',
			self::$MODULE_NAME . '.components.*',
		));
        
        // set layout path
        $dinamycPath = 'application.modules.'. self::$MODULE_NAME .'.views.layouts';
        $pathLayoutParent = YiiBase::getPathOfAlias($dinamycPath);
        $this->setLayoutPath($pathLayoutParent);
	}

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action))
        {
            $moduleIdentity = new ModuleIdentity();
            $moduleIdentity->authenticate($controller);
            
            return true;
        }
        else
            return false;
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias(self::$MODULE_NAME . '.assets'));
        return $this->_assetsUrl;
    }

    public function registerCssFile($file, $media = 'all')
    {
        $url = $this->getAssetsUrl() . $file;
        Yii::app()->clientScript->registerCssFile($url, $media);
    }

    public function getImage($file)
    {
        return $this->getAssetsUrl() . $file;
    }

    public function registerScriptFile($file, $position = 0)
    {
        $url = $this->getAssetsUrl() . $file;
        Yii::app()->clientScript->registerScriptFile($url, $position);
    }
}
