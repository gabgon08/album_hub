const newPassword = document.getElementById('newPassword');
const confirmNewPassword = document.getElementById('confirmNewPassword');

function validate(item){
    item.setCustomValidity('');
    item.checkValidity();

    if (item == confirmNewPassword){
        if (item.value === newPassword.value) item.setCustomValidity('');

        else item.setCustomValidity('As senhas não conferem');
    }
}

newPassword.addEventListener('input', function() {validate(newPassword)});
confirmNewPassword.addEventListener('input', function() {validate(confirmNewPassword)});


const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})