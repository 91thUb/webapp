<?php

/**
 * This is the model class for table "persemaian".
 *
 * The followings are the available columns in table 'persemaian':
 * @property integer $id
 * @property integer $id_tanaman
 * @property integer $id_lokasi
 * @property string $tanggal
 * @property integer $jumlah
 * @property string $latitude
 * @property string $longitude
 * @property string $gambar
 * @property string $deskripsi
 * @property integer $is_deleted
 * @property integer $is_approved
 */
class Persemaian extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Persemaian the static model class
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
		return 'persemaian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tanaman, id_lokasi, jumlah, is_deleted, is_approved', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude, gambar', 'length', 'max'=>255),
			array('tanggal, deskripsi', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_tanaman, id_lokasi, tanggal, jumlah, latitude, longitude, gambar, deskripsi, is_deleted, is_approved', 'safe', 'on'=>'search'),
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
			'id_tanaman' => 'Id Tanaman',
			'id_lokasi' => 'Id Lokasi',
			'tanggal' => 'Tanggal',
			'jumlah' => 'Jumlah',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'gambar' => 'Gambar',
			'deskripsi' => 'Deskripsi',
			'is_deleted' => 'Is Deleted',
			'is_approved' => 'Is Approved',
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
		$criteria->compare('id_tanaman',$this->id_tanaman);
		$criteria->compare('id_lokasi',$this->id_lokasi);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('is_approved',$this->is_approved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}