var menu = document.getElementsByClassName('menu')[0],
left_menu = document.getElementsByClassName('left_menu')[0];


window.onscroll = function() {
	var scrolled = window.pageYOffset || document.documentElement.scrollTop;

	menu.classList.toggle('fixed',scrolled>=100);
	// left_menu.classList.toggle('fixedleft',scrolled>=100);

	if (scrolled<=100){
		left_menu.style.top= 150-scrolled+'px';
	}else 
		left_menu.style.top = 50+'px';	
}




var bool = false;
var s = "";

for (var i=0;i<25;i++) {
	s += "<li>" + i + " hglhgldfkjggh </li>";
}

left_menu.innerHTML = s;

document.getElementById('new_item').onclick = function (){

	if (bool = !bool)
		document.getElementById("visib").classList.remove('visib');
	else
		document.getElementById("visib").classList.add('visib');
}

window.onresize = function() {
	document.getElementById("widhei").innerHTML = document.documentElement.clientWidth;
}

