var _jq_x;
var _jq_y;
var _jq_id_obj = null;
var _jq_id_db = null;
var _jq_action = null;
var _jq_obj_follow = null;
var _jq_follow = false;

$(document).ready(function(){
	$(document).mousemove(function(e){
		if (_jq_follow){
	        $("#"+_jq_id_obj).show();
	        $("#"+_jq_id_obj).css({
	            top: (e.pageY - 10) + "px",
	            left: (e.pageX - 50) + "px"
	        });
		}
    });
});

function segue(jq_id_obj){
	_jq_id_obj = jq_id_obj;
	_jq_follow = (_jq_follow == true) ? false : true ;
}