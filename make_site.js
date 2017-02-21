var menu = document.getElementsByClassName('menu')[0],
left_menu = document.getElementsByClassName('left_menu')[0];


window.onscroll = function() {
	var scrolled = window.pageYOffset || document.documentElement.scrollTop;

	menu.classList.toggle('fixed',scrolled>=100);
	// left_menu.classList.toggle('fixedleft',scrolled>=100);

	if (scrolled<=100){
		left_menu.style.top= 153-scrolled+'px';
	}else 
		left_menu.style.top = 53+'px';

	document.getElementById('showScroll').innerHTML = scrolled + 'px';
}


var bool = false;
var s = "";

for (var i=0;i<100;i++) {
	s += "<li>" + i + " hglhgldfkjggh </li>";
}

left_menu.innerHTML = s;

document.getElementById('new_item').onclick = function (){

	if (bool = !bool)
		left_menu.style.visibility = 'visible';
	else
		left_menu.style.visibility = 'hidden';

}