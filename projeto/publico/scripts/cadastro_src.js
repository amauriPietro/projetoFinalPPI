let inputs = document.querySelectorAll("input")
document.forms.cadastro.onsubmit = validaForm
function validaForm(e){
    let form = e.target
    let valido = true
    for(let formField of inputs)
        formField.nextElementSibling.textContent = ""
    for(let formField of inputs){
        if(formField.value === ""){
            let spanVerify = formField.nextElementSibling
            spanVerify.textContent = "O campo deve ser preenchido"
            valido = false
        }
    }
    if(!valido)
        e.preventDefault();
}