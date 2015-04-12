<?php 
/**
* KhoiPK
* Class Exam Model
*/
class question_model extends CI_Model
{
	protected $table = "tbl_question";

	public function listQuestion()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function insertQuestion($dataQuestion, $dataExam, $answerData,$answer)
	{
		//Insert Question
		$this->db->insert($this->table, $dataQuestion);
    	$quesId = $this->db->insert_id();

    	//Insert Exam
    	$dataExamQues = array("ques_id" => $quesId);
    	foreach ($dataExam as $key => $value) {
    		$dataExamQues['exam_id'] = $value;
    		$this->db->insert("exam_question", $dataExamQues);
    	}

    	//Insert Answer
    	$dataAnswer = array(
    					"ques_id" => $quesId,
    					"status"  =>0,
    					'ans_content'	=>'',
    				  );

    	foreach ($answerData as $keyAnswer => $valueAnswer) {
    		$dataAnswer['ans_content'] = $valueAnswer;

    		if($keyAnswer === (int)$answer){
    			$dataAnswer['status']	=	1;
    		}
    		$this->db->insert("tbl_answer", $dataAnswer);

    		$dataAnswer['status']	=	0;
    	}
	}

	public function updateQuestion($dataQuestion, $dataExam, $answerData,$id,$answer)
	{

		// update question
		$this->db->where('id',$id);
		$this->db->update('tbl_question',$dataQuestion);

		//update Answer

	  	$old_answer	=	$this->getAnwserByQuestion($id);
  	
	  	if(count($old_answer) > count($answerData)){
	  		for($i = 0; $i < count($old_answer) ; $i++){

	  			if(isset($answerData[$i])){
		  			if((int)$answer == $i){
		  				$status 	=	1;
		  			}

		  			$array 	=	array(
		  				'ans_content'	=>	$answerData[$i],
		  				'ques_id'		=>	$id,
		  				'status'		=>	$status,
	  				);
		  			$status 	=	0;
		  			$this->updateAnswer($old_answer[$i]->id,$array);

		  		}else{
		  			$this->deleteAnswer($old_answer[$i]->id);
		  		}

	  		}
	  	}else{
	  		for($i = 0; $i < count($answerData) ; $i++){

	  			if((int)$answer == $i){

	  				$status 	=	1;

	  			}

	  			$array 	=	array(
	  				'ans_content'	=>	$answerData[$i],
	  				'ques_id'		=>	$id,
	  				'status'		=>	$status,
  				);
	  			$status 	=	0;
	  			if(isset($old_answer[$i])){

		  			$this->updateAnswer($old_answer[$i]->id,$array);

	  			}else{
	  				$this->createAnswer($array);
	  			}

	  		}

	  	}

	  	// Update exam question
	  	$old_exam_question	=	$this->getExamQuestionByQuestion($id);

	  	if(count($old_exam_question) > count($dataExam)){
	  		for($i = 0; $i < count($old_exam_question) ; $i++){

	  			if(isset($dataExam[$i])){
		  			
		  			$array 	=	array(
		  				'ques_id'	=>	$id,
		  				'exam_id'	=>	$dataExam[$i],
	  				);

		  			$this->updateExamQuestion($old_exam_question[$i]->id,$array);

		  		}else{
		  			$this->deleteExamQuestion($old_exam_question[$i]->id);
		  		}

	  		}
	  	}else{
	  		for($i = 0; $i < count($dataExam) ; $i++){

	  			$array 	=	array(
	  				'ques_id'	=>	$id,
	  				'exam_id'	=>	$dataExam[$i],
  				);

	  			if(isset($old_exam_question[$i])){

		  			$this->updateExamQuestion($old_exam_question[$i]->id,$array);

	  			}else{
	  				$this->createExamQuestion($array);
	  			}

	  		}

	  	}


	}

	public function getOnce($id)
	{
		$data = $this->db->select("tbl_question.id,tbl_question.ques_content,tbl_question.ques_status")
				 ->from($this->table)
				 ->where("tbl_question.id",$id)
				 ->join("tbl_answer", "tbl_answer.ques_id = tbl_question.id", "left")
				 ->get()->row_array();

		$data['answer'] = $this->db->where("ques_id",$id)
								   ->order_by("id","ASC")
								   ->get("tbl_answer")
								   ->result_array();
		$data['exam']   = $this->db->where("ques_id",$id)
								   ->order_by("id","ASC")
								   ->get("exam_question")
								   ->result_array();
		return $data;
	}

	public function getAnwserByQuestion($question){
		if(isset($question) && is_numeric($question) && $question > 0){
			$this->db->select('id');
			$this->db->where('ques_id',$question);

			$query	=	$this->db->get('tbl_answer');

			return $query->result();
		}
		return false;
	}
	public function getExamQuestionByQuestion($question){
		if(isset($question) && is_numeric($question) && $question > 0){
			$this->db->select('id');
			$this->db->where('ques_id',$question);

			$query	=	$this->db->get('exam_question');

			return $query->result();
		}
		return false;
	}

	public function updateAnswer($id,$data){
		if(isset($id) && is_numeric($id) && $id > 0 && isset($data) && is_array($data) && !empty($data)){
			$this->db->where('id',$id);
			return $this->db->update('tbl_answer',$data);
		}
		return false;
	}

	public function deleteAnswer($id){
		if(isset($id) && is_numeric($id) && $id > 0){
			$this->db->where('id',$id);
			return $this->db->delete('tbl_answer');
		}
		return false;
	}

	public function createAnswer($data){
		if(isset($data) && is_array($data) && !empty($data)){
			$this->db->insert('tbl_answer',$data);
			return $this->db->insert_id();
		}
	}

	// Exam question

	public function updateExamQuestion($id,$data){
		if(isset($id) && is_numeric($id) && $id > 0 && isset($data) && is_array($data) && !empty($data)){
			$this->db->where('id',$id);
			return $this->db->update('exam_question',$data);
		}
		return false;
	}

	public function deleteExamQuestion($id){
		if(isset($id) && is_numeric($id) && $id > 0){
			$this->db->where('id',$id);
			return $this->db->delete('exam_question');
		}
		return false;
	}

	public function createExamQuestion($data){
		if(isset($data) && is_array($data) && !empty($data)){
			$this->db->insert('exam_question',$data);
			return $this->db->insert_id();
		}
	}

	public function getQuestionById($id){
		if(isset($id) && is_numeric($id) && $id > 0){
			$this->db->where('id',$id);
			$query 	=	$this->db->get('tbl_question');

			if($query->num_rows() > 0){
				return $query->first_row();
			}
		}
	}
	public function deleteQuestionById($id){
		if(isset($id) && is_numeric($id) && $id > 0){
			$this->db->where('id',$id);
			$this->db->delete('tbl_question');
		}
	}

	public function deleteAnswerByIdQues($id){
		if(isset($id) && is_numeric($id) && $id > 0){
			$this->db->where('ques_id',$id);
			$this->db->delete('tbl_answer');
		}
	}
	public function deleteExamQuestionByIdQues($id){
		if(isset($id) && is_numeric($id) && $id > 0){
			$this->db->where('ques_id',$id);
			$this->db->delete('exam_question');
		}
	}
}