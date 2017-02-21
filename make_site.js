var menu = document.getElementsByClassName('menu')[0],
left_menu = document.getElementsByClassName('left_menu')[0];


window.onscroll = function() {
	var scrolled = window.pageYOffset || document.documentElement.scrollTop;

	menu.classList.toggle('fixed',scrolled>=100);
	left_menu.classList.toggle('fixedleft',scrolled>=100);

	document.getElementById('showScroll').innerHTML = scrolled + 'px';
}