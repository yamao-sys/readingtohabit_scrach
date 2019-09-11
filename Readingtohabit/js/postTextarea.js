$(function(){
	reason_first = $('textarea[name="reason"]').val();
	learn_first = $('textarea[name="learn"]').val();
	activity_first = $('textarea[name="activity"]').val();

	$('form').submit(function(){
		if($('textarea[name="reason"]').val() ==  reason_first){
			$('textarea[name="reason"]').after('<input type = "hidden" name = "reason" value = ' + reason_first + '>');
		}
		if($('textarea[name="learn"]').val() ==  learn_first){
			$('textarea[name="learn"]').after('<input type = "hidden" name = "learn" value = ' + learn_first + '>');
		}
		if($('textarea[name="activity"]').val() ==  activity_first){
			$('textarea[name="activity"]').after('<input type = "hidden" name = "activity" value = ' + activity_first + '>');
		}
	})
});