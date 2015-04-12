// JavaScript Document
//Tạo đối tượng trong ajax
function create_obj(){
	var td = navigator.appName;
	if(td=='Microsoft Internet Explorer'){
		obj = new ActiveXOject('Microsoft.XMLHTTP');
	}else{
		obj = new XMLHttpRequest();	
	}
	return obj;
}
var http = create_obj();
//Hàm chọn tất cả
function checkall(class_name,obj) {
		var items = document.getElementsByClassName(class_name);
		if(obj.checked == true) //Đã được chọn
		{
			for(i=0; i < items.length ; i++)
				items[i].checked = true;
		}
		else { //Checkbox chưa được chọn
			for(i=0; i < items.length ; i++)
				items[i].checked = false;
		}
}
//Xóa nhieu
function delete_multil(class_name,url,back_url,mess){
     var check ="";
	 var giatri = Array();
	 var items = document.getElementsByClassName(class_name);
	 for (var i = 0; i < items.length; i++){
          if (items[i].checked){ 
		  	check += items[i].value;
			giatri[i] = items[i].value;
		  }
     }
     //return false;
     if(!check){ 
	 	alert(mess); 
	 }else{
		if(confirm("Bạn có thật sự muốn xóa không?")){
			http.open('GET',url+giatri,true);
			http.onreadystatechange=function(){
				if(http.readyState == 4 && http.status==200){
					var kq = http.responseText;
                    alert(kq);	
					location.href=back_url;
				}
			};
			http.send();
		}
	 }
}
//Delete mutilform
function delete_multil_form(class_name){
     var check ="";
     var box =true;
	 var giatri = Array();
	 var items = document.getElementsByClassName(class_name);
     for (var i = 0; i < items.length; i++){
          if (items[i].checked){ 
		  	check += items[i].value;
			giatri[i] = items[i].value;
		  }
     }
     if(!check){ 
	 	 alert("Chưa có bản ghi nào được chọn");
         return false; 
	 }else{
        box = confirm('Bạn có thật sự muốn xóa không?');
        if(box == false){
            return false;
        }
	 }
}
//Sắp xếp
(function($){
	sapxep = function(){
        var confirmBox;
        var current = $('.order').val();
        if(isNaN(current)){
            alert("Thứ tự phải là số. Vui lòng kiểm tra lại");
            return false;
        }
        confirmBox = confirm('Bạn có muốn thay đổi không');
        if(confirmBox == true){
            var order = $('.order').val();
            var id = $('.order').attr('getid');  
            $.ajax({
                url:"http://192.168.1.104/adminngc1/admin/menunews/sort/",
                type: "POST",
                data:"order="+order+"&id="+id,
                async:false, 
                success: function(kq){
                }
            });
            location.href="http://192.168.1.104/adminngc1/admin/menunews";
        }else{
            location.href="http://192.168.1.104/adminngc1/admin/menunews";
        }   
    }
})(jQuery)
	  
//Show div
function showDiv(val)
{
	if(val == 1)
	{
		document.getElementById('boxImage').style.display = 'block';
	}
	else
	{
		document.getElementById('boxImage').style.display = 'none';
	}
}
//Clear Text
function clearText(field){
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
//End Clear Text
//Action link
function actionLink(url) {
	window.location.href = url;
}
//End Action link
//Action Submit Button
function actionSubmit(formName) {
	eval('document.' + formName + '.submit();');
}
//End Action Submit

//Action Search Button
function actionSearch(formName, inpuText) {
    if(document.getElementById(inpuText).value == '') {
        alert('Hãy nhập từ khóa tìm kiếm');
        document.getElementById(inputText).focus();
        return false;
    } else {
        eval('document.' + formName + '.submit();');    
    }
}
//End Action Search
//ActionDelete
function actionDelete(formName) {
	var a=new Array();
	a=document.getElementsByName("cid[]");
	var p=0;
	for(i=0;i<a.length;i++){
		if(a[i].checked){
			p=1;
		}
	}
	if (p==0){
		alert('Chưa có bản ghi nào được chọn');
		return false;
	} else {
	   	if(confirm('Bạn có thật sự muốn xóa không?')) {
   		   eval('document.' + formName + '.submit();');
		   return true;
        } else {
            return false;
        }
	}
			

}

//End actionDelete
function PopupCenter(pageURL, title,w,h) {
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

$(document).ready(function(){
	$('#length').text(' Tối đa là 156 ký tự');
	$('#meta_desc').keyup(function () {
	    var max = 156;
	    var len = $(this).val().length;
	    if (len >= max) {
	        $('#length').text(' you have reached the limit');
	    } else {
	        var ch = max - len;
	        $('#length').text(ch + ' characters left');
	    }
	})
})