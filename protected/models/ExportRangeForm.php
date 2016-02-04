<?php 
/**
* ExportRangeForm
*/
class ExportRangeForm extends CFormModel
{
	public $date_from;
	public $date_to;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('date_from, date_to', 'required'),
			array('date_from', 'date_not_greater'),
		);
	}
	public function date_not_greater($attr , $params)
	{
		$date_from = strtotime($this->date_from);
		$date_to = strtotime($this->date_to);
		if ( $date_from > $date_to  ) {
			$this->addError($attr , "Invalid range . Make sure that the date_from is less than that of date_to. ");
		}
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'date_from'=>'Date from',
			'date_to'=>'Date to',
		);
	}
}