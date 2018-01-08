window.onclick = function(event) {
    if(event.target === document.getElementById('frmLogin')) {
        document.getElementById('frmLogin').style.display = 'none';
    }
    if(event.target === document.getElementById('frmRegister')) {
        document.getElementById('frmRegister').style.display = 'none';
    }
    if(event.target === document.getElementById('userMenu')) {
        document.getElementById('userMenu').style.display = 'none';
    }
};
function check(input) {
    if (input.value !== document.getElementById('password1').value) {
        input.setCustomValidity('Password Must be Matching.');
    } else {
        // input is valid -- reset the error message
        input.setCustomValidity('');
    }
}
