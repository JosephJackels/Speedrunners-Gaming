var modal = document.getElementById("login-modal-window");
var open = document.getElementById("login-modal-window-open");
var close = modal.querySelector(".modal-close");

open.onclick = function(){
	modal.style.display = 'block';
}

close.onclick = function(){
	modal.style.display = "none";
} 

window.onclick = function(event) {
	if (event.target == modal){
		modal.style.display = "none";
	}
}