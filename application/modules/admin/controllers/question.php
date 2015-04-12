<?php
/**
* Class Question
* KhoiPK
* 17/03/2014
*/
class question extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("exam_model");
		$this->load->model("question_model");
	}
	public function index()
	{

		$data = array();
		$data['listQuestin'] = $this->question_model->listQuestion();
		$data['title'] 	     = "Danh sách câu hỏi";
		$data['template']    = "question/list";
    	$this->load->view("layout",$data);
	}

	public function create()
	{
		$errorExam		=	"";
		$errorQuestion	=	"";
		$errorAnswer	=	"";
		$data['infoQuestion']	=	array(
			'answer'	=>	array()
		);

		if($this->input->post("btnAdd")) {

			$question 	=	$this->input->post("ques_content");

			if($question === "&#160;" || $question === ""){
				$errorQuestion	=	"Nội dung câu hỏi không được để trống";
			}

			$exam 		=	$this->input->post('exam');
			if(!$exam){
				$errorExam	=	"Vui lòng chọn đề thi";
			}
			$checkAnwer		=	true;
			$formAnswerData = $this->input->post('answer');
			$answerChoose	=	$this->input->post('answerchoose');
			if($formAnswerData){

				foreach($formAnswerData as $item){
					if($item === "&#160;" || !$item){
						$checkAnwer	=	false;
						$errorAnswer= "Vui lòng điền đầy đủ câu trả lời";
						break;
					}
				}
			}
			if($formAnswerData){

				for($i = 0; $i < count($formAnswerData); $i++){
					if($i == (int)$answerChoose){
						$array	=	array(
							'ans_content'	=>	$formAnswerData[$i],
							'status'		=>	1
						);
					}else{
						$array	=	array(
							'ans_content'	=>	$formAnswerData[$i],
							'status'		=>	0
						);
					}

					array_push($data['infoQuestion']['answer'], $array);
				}
			}

			$formData 		= $this->getFormDataQuestion();

			if($checkAnwer && !$errorAnswer && !$errorQuestion && !$errorExam){

				$this->question_model->insertQuestion($formData, $_POST['exam'], $formAnswerData,$answerChoose);
				redirect(site_url('admin/question'));
			}

			
		}
		if(isset($data['infoQuestion']['answer']) && !empty($data['infoQuestion']['answer'])){
			$data['numberAnswer']	=	count($data['infoQuestion']['answer']);
		}else{
			$data['numberAnswer']	=	2;
		}
		
		$data['exam'] 			= isset($_POST['exam']) ? $_POST['exam'] : array();
		$data['examList']  		= $this->exam_model->getAll();
		$data['title'] 	   		= "Thêm câu hỏi";
		$data['template']  		= "question/form";
		$data['errorExam'] 		= $errorExam;
		$data['errorAnswer']	= $errorAnswer;
		$data['errorQuestion']	=	$errorQuestion;
    	$this->load->view("layout",$data);
	}

	public function update($id)
	{

		$errorExam		=	"";
		$errorQuestion	=	"";
		$errorAnswer	=	"";
		$dataArray		=	array();

		if($this->input->post("btnAdd")) {

			$question 	=	$this->input->post("ques_content");

			if($question === "&#160;" || $question === ""){
				$errorQuestion	=	"Nội dung câu hỏi không được để trống";
			}

			$exam 		=	$this->input->post('exam');
			if(!$exam){
				$errorExam	=	"Vui lòng chọn đề thi";
			}

			$checkAnwer		=	true;
			$formAnswerData = $this->input->post('answer');
			$answerChoose	=	$this->input->post('answerchoose');
			if($formAnswerData){

				foreach($formAnswerData as $item){
					if($item === "&#160;" || !$item){
						$checkAnwer	=	false;
						$errorAnswer= "Vui lòng điền đầy đủ câu trả lời";
						break;
					}
				}
			}
			if($formAnswerData){

				for($i = 0; $i < count($formAnswerData); $i++){
					if($i == (int)$answerChoose){
						$array	=	array(
							'ans_content'	=>	$formAnswerData[$i],
							'status'		=>	1
						);
					}else{
						$array	=	array(
							'ans_content'	=>	$formAnswerData[$i],
							'status'		=>	0
						);
					}

					array_push($dataArray, $array);
				}
			}

			$formData 		= $this->getFormDataQuestion();

			if($checkAnwer && !$errorAnswer && !$errorQuestion && !$errorExam){
				$this->question_model->updateQuestion($formData, $_POST['exam'], $formAnswerData, $id,$answerChoose );
				redirect(site_url('admin/question'));
			}
		}

		$data['errorExam']    = isset($errorExam) ? $errorExam : "";
		$data['examList']     = $this->exam_model->getAll();
		$data['infoQuestion'] = $this->question_model->getOnce($id);

		if(isset($dataArray) && !empty($dataArray)){
			$data['infoQuestion']['answer']	=	$dataArray;
		}

		//$data['answerInfo']   = $data['infoQuestion']['answer'];

		if($data['infoQuestion']){
			$data['numberAnswer']	=	count($data['infoQuestion']['answer']);
		}

		if(isset($data['infoQuestion']['exam']) && $data['infoQuestion']['exam'] != null ) {
			foreach ($data['infoQuestion']['exam'] as $key => $value) {
				$data['exam'][] = $value['exam_id'];
			}
		}
		$data['errorExam'] 		= $errorExam;
		$data['errorAnswer']	= $errorAnswer;
		$data['errorQuestion']	=	$errorQuestion;
		$data['title']        = "Sửa câu hỏi";
		$data['template']     = "question/form";

		$this->load->view("layout",$data);	
	}

	public function delete($id){

		$question 	=	$this->question_model->getQuestionById($id);

		if($question){
			$this->question_model->deleteQuestionById($id);
			$this->question_model->deleteAnswerByIdQues($id);
			$this->question_model->deleteExamQuestionByIdQues($id);
		}

		redirect(site_url('admin/question'));

	}

	private function getFormDataQuestion()
	{
		$data = array(
					"ques_content" => $this->input->post("ques_content"), 
					"ques_status"  => $this->input->post("ques_status")
				);
		return $data;
	}

	public function validation()
    {
        $this->form_validation->set_rules("ques_content","Nội dung câu hỏi","trim|required");

        $this->form_validation->set_message('required', '%s không được để trống');          
        $this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
        $this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
        $this->form_validation->set_message('matches', '%s không trùng nhau');
        $this->form_validation->set_message("valid_email","%s không đúng định dạng");
        $this->form_validation->set_message("numeric","%s phải là định dạng số");
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        
        if($this->form_validation->run()) {
        	return true;
        } else {
        	return false;
        }
    }
}