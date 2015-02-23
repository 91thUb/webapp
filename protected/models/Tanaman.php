<?php

/**
 * This is the model class for table "tanaman".
 *
 * The followings are the available columns in table 'tanaman':
 * @property integer $id
 * @property string $nama_indonesia
 * @property string $nama_ilmiah
 * @property string $nama_sinonim
 * @property string $nama_lokal
 * @property string $deskripsi
 * @property string $gambar
 */
class Tanaman extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tanaman the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tanaman';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_indonesia, nama_ilmiah, nama_sinonim, nama_lokal, gambar', 'length', 'max'=>255),
			array('deskripsi', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nama_indonesia, nama_ilmiah, nama_sinonim, nama_lokal, deskripsi, gambar', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama_indonesia' => 'Nama Indonesia',
			'nama_ilmiah' => 'Nama Ilmiah',
			'nama_sinonim' => 'Nama Sinonim',
			'nama_lokal' => 'Nama Lokal',
			'deskripsi' => 'Deskripsi',
			'gambar' => 'Gambar',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nama_indonesia',$this->nama_indonesia,true);
		$criteria->compare('nama_ilmiah',$this->nama_ilmiah,true);
		$criteria->compare('nama_sinonim',$this->nama_sinonim,true);
		$criteria->compare('nama_lokal',$this->nama_lokal,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('gambar',$this->gambar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}