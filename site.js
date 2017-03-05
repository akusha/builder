//var menu = document.getElementsByClassName('menu')[0],
//left_menu = document.getElementsByClassName('left_menu')[0];


var t;
function up() {
  var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
  if(top < 1000) {
    window.scrollBy(0, 60);
    t = setTimeout('up()',30);
  } else clearTimeout(t);
  return false;
}

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