<?php

class ModuleIdentity 
{
    public function authenticate($controller)
    {
        // jika user mengakses controller user untuk login dan logout, maka tampilkan
        if(strtolower($controller->module->getName()) == 'core' && strtolower($controller->id) == 'user')
        {
            return;
        }
        // jika bukan mengakses controller user, cek apakah user sudah login atau belum
        else
        {
            // jika user belum login lempar ke halaman login
            if(Yii::app()->user->isGuest)
            {
                $this->redirectToLogin($controller);
            }
        }
        
        $moduleCriteria = new CDbCriteria();
        $moduleCriteria->compare('url', $controller->id);
        
        $module = Module::model()->find($moduleCriteria);
        
        if($module == null)
        {
            return;
        }
        else
        {
            $modulePrivilageCriteria = new CDbCriteria();
            $modulePrivilageCriteria->compare('module_id', $module->id);
            $modulePrivilageCriteria->compare('user_level_id', Yii::app()->user->userLevel);
            
            $modulePrivilage = ModulePrivilage::model()->find($modulePrivilageCriteria);
            if($modulePrivilage == null)
            {
                throw new CHttpException(404,'The requested page cannot be found.');
            }
            else
            {
                return;
            }
        }
    }
    
    private function redirectToLogin($controller)
    {
        $loginUrl = Yii::app()->baseUrl . '/core/user/login';
        $controller->redirect($loginUrl);
    }
}