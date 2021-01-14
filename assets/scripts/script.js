//PAGING

var posts = $('.new-posts'),
	pagesLinks = $('.pages-links a');

posts.not(':first').hide();

pagesLinks.on('click', function(event){
	event.preventDefault();

	var id = $(this).attr('href');
	posts.hide();
	$(id).fadeIn();

});

//COMENTS
