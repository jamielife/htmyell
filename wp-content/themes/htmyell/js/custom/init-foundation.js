//jQuery(document).foundation();
jQuery(document).foundation({
  equalizer : {
    // Specify if Equalizer should make elements equal height once they become stacked.
    equalize_on_stack: true
  }
});

$(document).ready(function(){
	$('.commentCount').each(function(){
		$(this).css({ 'line-height': $(this).height() + 'px' });
	})
});
