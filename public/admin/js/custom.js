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
	 for (var i = 0; i < items.length; i++) {
          if (items[i].checked){ 
		  	check += items[i].value;
			giatri[i] = items[i].value;
		  }
     }
     if(!check){ 
	 	alert(mess); 
	 }else{
		if(confirm("Bạn có thật sự muốn xóa không?")){
			http.open('GET',url+giatri,true);
			http.onreadystatechange=function(){
				if(http.readyState == 4 && http.status==200){
					var kq = http.responseText;	
					location.href=back_url;
				}
			};
			http.send();
		}
	 }
}


      
      



