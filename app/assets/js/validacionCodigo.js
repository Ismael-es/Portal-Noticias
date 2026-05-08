

let formulario=document.getElementById('formulario-codigo');
let inputCodigo=document.querySelector('[name="codigo"]');

let enviar=document.querySelector('[name="enviarCodigo"]');

enviar.addEventListener('click', () =>{


      let valido=formulario.checkValidity();

      let errores=document.getElementById('errores-total');

      if(valido){
        valido.submit();
      }else{

        errores.innerHTML = "";

        if(inputCodigo.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar el código</div>`;
        }else if(inputCodigo.validity.patternMismatch){
            errores.innerHTML+=` <div class="alert alert-danger">El código debe contener solo números</div>`;
        }

      }





      

})