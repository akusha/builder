//var menu = document.getElementsByClassName('menu')[0],
//left_menu = document.getElementsByClassName('left_menu')[0];


var t, top_el, top_h2, kk;
var step, speed, href;
function up(id, st, sp) {
	href=id;
	step = st||40;
	speed = sp||10;
//	if(st===undefined) step=40; 
//	if(sp===undefined) speed=20;
	top_el = document.getElementById(href).getBoundingClientRect().top;
	if(top_el>step){
		window.scrollBy(0, step);
		t = setTimeout('up("'+href+'", '+step+', '+speed+')', speed);
	} else {
		clearTimeout(t);
		window.scrollBy(0, top_el);
	}
}

window.onscroll = function(){
	top_h2 = document.getElementById("img2").getBoundingClientRect().top;
	document.getElementById("h2").innerHTML = top_h2;
}

//function scroll(){
//  	if (top1<s) {
//		s=top1;
//		window.scrollBy(0, s);	
//		clearInterval(t);
//	}
//else 
//{
//	window.scrollBy(0, s);
//	top1 = top1-s;}
//}

//function up() {
//	top1 = document.getElementById("img2").getBoundingClientRect().top;
//	
////  var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
//	if(top1 > 40) {
//    window.scrollBy(0, 40);
//    t = setTimeout('up()',5);
//  	} else { 
//		clearTimeout(t);
//		window.scrollBy(0, s);
//		}
//  return false;
//}
//function rar(){
//window.onscroll = function() {	
//	var gget = document.getElementById("img2").getBoundingClientRect();
//	document.getElementById("rar").innerHTML=gget.top;
//}

//window.onscroll = function() {
//	var scrolled = window.pageYOffset || document.documentElement.scrollTop;
//
//	menu.classList.toggle('fixed',scrolled>=100);
//	// left_menu.classList.toggle('fixedleft',scrolled>=100);
//
//	if (scrolled<=100){
//		left_menu.style.top= 150-scrolled+'px';
//	}else 
//		left_menu.style.top = 50+'px';	
//}
//
//
//
//
//var bool = false;
//
//
//
//document.getElementById('new_item').onclick = function (){
//
//	if (bool = !bool)
//		document.getElementById("visib").classList.remove('visib');
//	else
//		document.getElementById("visib").classList.add('visib');
//}
//
////window.onresize = function() {
////	document.getElementById("widhei").innerHTML = document.documentElement.clientWidth;
////}
//
//
//
//window.onload = function(){
//	
//	var li = document.getElementsByClassName('item');
//	
//	for (var i=0;i<li.length;i++){
//		
//		li[i].onclick = function (){
//			
//			document.getElementsByClassName('conteiner')[0].innerHTML = this.getAttribute('value2');
//			
//		}
//		
//	}	
//	
//}