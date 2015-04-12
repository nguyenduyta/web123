function loadComment(cid){
	$.ajax({
		url: "/index/comment-expert",
		data: "",
		type: "POST",
		success: function(data){
			$("#c_"+cid).after(data);
			$("#c_"+cid).css("background","#F2F4F6");
		},
		error: function (data){
			alert("Lỗi từ phía sever! Bạn vui lòng thử lại");
		}
	});
}
function control_p(f,cid){
	if(f){
		$("#content"+cid).css("height","auto");
		$("#control_p"+cid).html("Thu gọn");
		$("#control_p"+cid).attr("onclick","control_p(false,'"+cid+"')");
	}
	else{
		$("#content"+cid).css("height","36px");
		$("#control_p"+cid).html("Xem thêm");
		$("#control_p"+cid).attr("onclick","control_p(true,'"+cid+"')");
	}
}