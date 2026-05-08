

let formulario=document.getElementById('formulario-contraseña');
let inputPassword=document.querySelector('[name="password"]');

let enviar=document.querySelector('[name="guardarContraseña"]');

enviar.addEventListener('click', () =>{


      let valido=formulario.checkValidity();

      let errores=document.getElementById('errores-total');

      if(valido){
        valido.submit();
      }else{

        errores.innerHTML = "";

        if(inputPassword.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar la contraseña</div>`;
        }else if(inputPassword.validity.patternMismatch){
            errores.innerHTML+=` <div class="alert alert-danger">La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número</div>`;
        }

      }





      

})