

let formularioR=document.getElementById('formulario-login');
let inputMail=document.querySelector('[name="mail"]');
let inputContraseña=document.querySelector('[name="contraseña"]');

let enviar=document.querySelector('[name="iniciarSesion"]');

enviar.addEventListener('click', () =>{


      let valido=formularioR.checkValidity();

      let errores=document.getElementById('errores-total');

      if(valido){
        valido.submit();
      }else{

        if(inputMail.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar el mail</div>`;
        }

        if(inputContraseña.validity.valueMissing){
             errores.innerHTML+=` <div class="alert alert-danger">debe ingresar la contraseña ahseeee</div>`;
        }



      }

})