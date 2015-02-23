<?php

class MyModel extends CActiveRecord
{
    public function behaviors()
    {
        return array(
            'ERememberFiltersBehavior' => array(
                'class' => 'application.components.ERememberFiltersBehavior',
                'defaults' => array(),
                'defaultStickOnClear' => false
            ),
        );
    }
}
