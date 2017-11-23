var regFrm = document.getElementById('frmRegister');
var logFrm = document.getElementById('frmLogin');
var regBtn = document.getElementById("registerBtn");
var logBtn = document.getElementById("loginBtn");
var closeFrmBtn = document.getElementsByClassName("close")[0];
logBtn.onclick = function() {logFrm.style.display = "block";};
regBtn.onclick = function() {regFrm.style.display = "block";};
//closeFrmBtn.onclick = function() {logFrm.style.display = "none";regFrm.style.display = "none";};
window.onclick = function(event) {if(event.target === regFrm){regFrm.style.display = "none";}if(event.target === logFrm){logFrm.style.display = "none";}};