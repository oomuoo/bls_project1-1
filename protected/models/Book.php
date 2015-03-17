<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 * @property string $description
 * @property integer $category_id
 * @property string $picture
 * @property string $status
 * @property integer $member_id
 * @property integer $score_id
 * @property integer $type_id
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Member $member
 * @property Score $score
 * @property Type $type
 * @property Download[] $downloads
 */
class Book extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, category_id, status', 'required'),
			array('category_id, member_id, score_id, type_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('status', 'length', 'max'=>1),
			//array('file', 'file', 'types'=>'docx', 'allowEmpty' => true),
			array('picture', 'length', 'max'=>150),
			array('picture', 'file', 'types'=>'jpg, gif, png, jpeg', 'allowEmpty' => true), // rule for file upload
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, create_date, update_date, description, category_id, picture, status, member_id, score_id, type_id, file_id', 'safe', 'on'=>'search'),
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
			//'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
			'score' => array(self::BELONGS_TO, 'Score', 'score_id'),
			'type' => array(self::BELONGS_TO, 'Type', 'id'),
			'downloads' => array(self::HAS_MANY, 'Download', 'book_id'),
			'files' => array(self::BELONGS_TO, 'Files', 'file_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'ชื่อหนังสือ',
			'create_date' => 'วันที่สร้างหนังสือ',
			'update_date' => 'วันที่แก้ไขหนังสือ',
			'description' => 'รายละเอียด',
			'category_id' => 'หมวดหมู่หนังสือ',
			'picture' => 'รูปภาพ',
			'status' => 'สถานะ',
			'member_id' => 'นามปากกา',
			'score_id' => 'คะแนน',
			'type_id' => 'ประเภทหนังสือ',
			'file_id' => 'ไฟล์หนังสือที่ต้องการอัพโหลด',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('score_id',$this->score_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('file_id',$this->file_id,true);
		$criteria->addCondition('member_id ='.Yii::app()->user->id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}
	

	public function searchForAll()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('score_id',$this->score_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('file_id',$this->file_id,true);
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}
	
	public function searchForHealthAndBeauty()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id = 2);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('score_id',$this->score_id);
		$criteria->compare('type_id',$this->type_id);
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
	}
	
	public function searchForBiography()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id = 3);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('score_id',$this->score_id);
		$criteria->compare('type_id',$this->type_id);
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
	}
	
	public function searchForTravel()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id = 4);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('score_id',$this->score_id);
		$criteria->compare('type_id',$this->type_id);
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
	}
	
	public function searchForMusic()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id = 5);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('score_id',$this->score_id);
		$criteria->compare('type_id',$this->type_id);
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
	}
	
	public function searchForGeneral()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id = 6);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('score_id',$this->score_id);
		$criteria->compare('type_id',$this->type_id);
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getcategory()
	{
		$list = array();
		$category = Category::model()->findAll(array('order'=> 'name'));
		$list = CHtml::listData($category,'id','name');
		return $list;
	}
	
	public function gettype()
	{
		$list = array();
		$type = Type::model()->findAll(array('order'=> 'name'));
		$list = CHtml::listData($type,'id','name');
		return $list;
	}
	
	public function afterFind(){
	
		if($this->status == 'M'){
			$this->status = 'เฉพาะสมาชิก';
	
		}else if($this->status == 'P'){
			$this->status = 'สาธารณะ';
	
		}else{
			$this->status = 'เฉพาะผู้เขียน';
		}
	
		return true;
	}
	
	
}
