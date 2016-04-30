function show(id){
	id.style.display="block";
	document.getElementById("mask").style.display="block";
}
function cancel(argument) {
	document.getElementById("mask").style.display="none";
	argument.parentNode.parentNode.style.display="none";
}