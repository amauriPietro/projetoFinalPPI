let inputs = document.querySelectorAll("input");
async function handleSignUp(event) {
  event.preventDefault();
  const form = document.forms.formLogin;
  let valido = true;
  for (let formField of inputs)
    formField.nextElementSibling.textContent = "";
  for (let formField of inputs) {
    if (formField.value === "") {
      let spanVerify = formField.nextElementSibling;
      spanVerify.textContent = "O campo deve ser preenchido";
      valido = false;
    }
  }
  if(valido){
      try {
    const response = await fetch("/publico/scripts/cadastra.php", {
      method: "post",
      body: new FormData(form),
    });
    if (!response.ok) throw new Error(response.statusText);
    var bodyText = await response.text();
    const result = JSON.parse(bodyText);

    if (result.success) {
      window.location = result.detail;
      alert("Cadastrei com sucesso");
    } else {
      document.querySelector("#signUpFailMsg").style.display = "block";
      document.querySelector("#signUpFailMsg").textContent = result.detail;
      form.senha.value = "";
      form.senha.focus();
    }
  } catch (e) {
    console.log(bodyText ?? "");
    console.error(e);
  }
  }

}