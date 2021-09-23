$(function() {
    $("li").click(function(e) {
	e.preventDefault();
	$("li").removeClass("selected");
	$(this).addClass("selected");
    });

    $('ul.tabrow').each(function() {
	var $active, $content, $links = $(this).find('a');

	$active = $($links.filter('[href="' + location.hash + '"]')[1] || $links[0]);
	$active.addClass('active');
	$content = $($active.attr('href'));

	$links.not($active).each(function() {
	    $($(this).attr('href')).hide();
	});

	$(this).on('click', 'a', function(e) {
	    $active.removeClass('active');
	    $content.hide();
	    $active = $(this);
	    $content = $($(this).attr('href'));
	    $active.addClass('active');
	    $content.show();
	    e.preventDefault();
	});
    });
});
