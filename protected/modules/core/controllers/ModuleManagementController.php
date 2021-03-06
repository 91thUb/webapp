<?php

class ModuleManagementController extends Controller
{

    public $functionName = 'Module Management';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $userLevel = UserLevel::model()->findAll();
        $preCheckedArray = array();

        if (isset($model->privilages))
        {
            foreach ($model->privilages as $value)
            {
                $preCheckedArray[] = $value->user_level_id;
            }
        }

        $this->render('view', array(
            'model' => $model,
            'userLevel' => $userLevel,
            'preCheckedArray' => $preCheckedArray,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Module;
        $userLevel = UserLevel::model()->findAll();
        $preCheckedArray = array();

        if (isset($_POST['privilages']))
        {
            $preCheckedArray = Yii::app()->request->getPost('privilages');
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Module']))
        {
            $model->attributes = $_POST['Module'];

            $model->arrPrivilages = Yii::app()->request->getPost('privilages');
            if ($model->parent == 0 || count($model->arrPrivilages))
            {
                $model->hasPrivilage = true;
            }

            if ($model->save())
            {
                Yii::app()->user->setFlash('success', 'Module "'. $model->name .'" saved!');
                $model = new Module;
                $preCheckedArray = array();
            }
        }

        $this->render('create', array(
            'model' => $model,
            'userLevel' => $userLevel,
            'preCheckedArray' => $preCheckedArray,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $userLevel = UserLevel::model()->findAll();
        $preCheckedArray = array();

        if (isset($model->privilages))
        {
            foreach ($model->privilages as $value)
            {
                $preCheckedArray[] = $value->user_level_id;
            }
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Module']))
        {
            if (isset($_POST['privilages']))
            {
                $preCheckedArray = Yii::app()->request->getPost('privilages');
            }
            else
            {
                $preCheckedArray = array();
            }
            
            $model->attributes = $_POST['Module'];

            $model->arrPrivilages = Yii::app()->request->getPost('privilages');
            if ($model->parent == 0 || count($model->arrPrivilages))
            {
                $model->hasPrivilage = true;
            }

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
            'userLevel' => $userLevel,
            'preCheckedArray' => $preCheckedArray,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
//        if (Yii::app()->request->isPostRequest)
//        {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            
            if($model->validationBeforeDelete())
            {
                $this->loadModel($id)->delete();
                Yii::app()->user->setFlash('success', 'Module "'. $model->name .'" deleted!');
            }
            else
            {
                Yii::app()->user->setFlash('error', $model->onDeleteMessage);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        }
//        else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionAdmin()
    {
        $this->redirect('index');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Module('search');
        
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Module::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'module-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
