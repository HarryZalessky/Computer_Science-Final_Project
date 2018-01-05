var regFrm = document.getElementById('frmRegister');
var logFrm = document.getElementById('frmLogin');
var regBtn = document.getElementById('registerBtn');
var logBtn = document.getElementById('loginBtn');
var regLoginBtn = document.getElementById('registerBtnLogin');
var logRegBtn = document.getElementById('loginBtnRegister');
var closeFrmBtn = document.getElementsByClassName('close')[0];
logBtn.onclick = function() {logFrm.style.display = 'block';};
regBtn.onclick = function() {regFrm.style.display = 'block';};
regLoginBtn.onclick = function() {logFrm.style.display = 'none';regFrm.style.display = 'block';};
logRegBtn.onclick = function() {logFrm.style.display = 'block';regFrm.style.display = 'none';};
//closeFrmBtn.onclick = function() {logFrm.style.display = "none";regFrm.style.display = "none";};
window.onclick = function(event) {if(event.target === regFrm){regFrm.style.display = "none";}if(event.target === logFrm){logFrm.style.display = "none";}};
function check(input) {
                    if (input.value !== document.getElementById('password1').value) {
                        input.setCustomValidity('Password Must be Matching.');
                    } else {
                        // input is valid -- reset the error message
                        input.setCustomValidity('');
                    }
                }