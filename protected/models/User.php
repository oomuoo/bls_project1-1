<?php
class User extends CActiveRecord
{
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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('username, password', 'required'),
				array('username', 'unique'),
				array('status', 'numerical', 'integerOnly'=>true),
				array('username ', 'length', 'max'=>45),
				array('password','length', 'min'=>6),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array('id, username, password, status', 'safe', 'on'=>'search'),
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
				//'admins' => array(self::HAS_MANY, 'Admin', 'user_id'),
				'members' => array(self::HAS_ONE, 'Member', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'username' => 'ชื่อผู้ใช้',
				'password' => 'รหัสผ่าน',
				'status' => 'Status',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function searchForAll()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
}
