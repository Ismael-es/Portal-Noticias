

let formulario=document.getElementById('formulario-registro');
let inputnombre=document.querySelector('[name="nombreYape"]');
let inputmail=document.querySelector('[name="mail"]');
let inputContraseña=document.querySelector('[name="contraseña"]');
  let inputRoles = formulario.querySelector('[name="roles[]"]');

let enviar=document.querySelector('[name="enviarRegistro"]');

enviar.addEventListener('click', () =>{


      let valido=formulario.checkValidity();

      let errores=document.getElementById('errores-total');

      if(valido){
        valido.submit();
      }else{    

        errores.innerHTML = "";

        if(inputnombre.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar el nombre</div>`;
        }else if(inputnombre.validity.patternMismatch){
            errores.innerHTML+=` <div class="alert alert-danger">El nombre debe contener solo letras</div>`;
        }

        if(inputmail.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar el email</div>`;
        }else if(inputmail.validity.patternMismatch){
            errores.innerHTML+=` <div class="alert alert-danger">El email no es válido</div>`;
        }

        if(inputContraseña.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar la contraseña</div>`;
        }else if(inputContraseña.validity.patternMismatch){
            errores.innerHTML+=` <div class="alert alert-danger">La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número</div>`;
        }

        if (inputRoles.validity.valueMissing) {
            errores.innerHTML += `<div class="alert alert-danger">Debe seleccionar un rol de la lista</div>`;
        }

      }





      

})