<?php
class grid
{
	protected $openTable = '<table class="data" width="100%" cellpadding="0" cellspacing="0">';
	protected $form 	 = '
			                <tr>
			                    <td><input type="text" name="id" value="" /></td>
			                    <td><input type="text" name="name" value="" size="45" /></td>
			                    <td colspan="5" align="right">
			                        <input type="submit" name="filter" value="Filter" />
			                    </td>
			                </tr>';
	protected $headTable = array();        
	public function addColumn($field,$label,$option = array()) 
	{
		$newOption = "";
		if(is_array($option) && $option != null) {
			foreach ($option as $key => $value) {
				$newOption .= $key.'=>'.$value.',';
			}
		}
		echo $newOption;
		$data = array(
					$field.'=>'.$label,
					$newOption
				);
		$this->headTable[] = $data;
	}
	public function getColumn()
	{
		return $this->headTable;
	}

	public function createTable()
	{
		return $this->headTable;
	}
}