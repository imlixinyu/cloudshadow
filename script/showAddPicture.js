var cameraBtn=document.getElementById("cameraBtn");
var cameraAddZone=document.getElementById("cameraZone");
var mask=document.getElementById("mask");
var cancelBtn=document.getElementById("cancelBtn");
cameraAddZone.style.display="none";
mask.style.display="none";
cameraBtn.onclick=function (argument) {
	cameraAddZone.style.display="block";
	mask.style.display="block";
}
cancelBtn.onclick=function (argument) {
	cameraAddZone.style.display="none";
	mask.style.display="none";
}