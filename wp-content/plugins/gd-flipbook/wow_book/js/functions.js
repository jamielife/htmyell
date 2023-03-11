function triggerAlert(appendElem, type, message, displayTime){
	appendElem.append('<div data-alert class="alert-box '+type+'">'+message+'</div>');

	var alertTimer = setInterval(timerFunction, displayTime);
	
	function timerFunction() {
		$('.alert-box').fadeOut('slow');
	    clearInterval(alertTimer);
	}						
}

function getSortedKeys(obj) {
    var keys = []; for(var key in obj) keys.push(key);
    return keys.sort(function(a,b){ 
	    return obj[a]-obj[b];
	});
}				

function answerOccurrence(answers){
	answers.forEach(function(x) { totals[x] = (totals[x] || 0)+1; });
	return totals;
}				

function displayResults(result){
	$('.answer-descriptions').hide();
	
	var isVowel = function(letter) {						
	    var vowels = ["a", "e", "i", "o", "u"];						
	    for(var i = 0; i < vowels.length; i++){
	        if(letter === vowels[i]){
	            return true;
	         }
	    }						    
	    return false;
	};
	
	if(isVowel(result[0])){
		indefiniteArticle = "an";
	} else {
		indefiniteArticle = "a";
	}
	
	$('#results h2').html('You are '+ indefiniteArticle +' ' + result);
	$('#results #' + result.toLowerCase()).fadeIn();
}

function handleResultData(actOnUrl, email, answer, result){	
	$.ajax({
        type: "POST",
        url: actOnUrl,
        data: 'answers=' + answers + '&result=' + result + '&email=' + email,
        success: function(msg){
			//console.log(msg);
        }
    });						
}