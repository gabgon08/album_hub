const password = document.getElementById('password');
const passwordConfirm = document.getElementById('passwordConfirm');

function validate(item){
    item.setCustomValidity('');
    item.checkValidity();

    if (item == passwordConfirm){
        if (item.value === password.value) item.setCustomValidity('');

        else item.setCustomValidity('As senhas não conferem');
    }
}


password.addEventListener('input', function() {validate(password)});
passwordConfirm.addEventListener('input', function() {validate(passwordConfirm)});