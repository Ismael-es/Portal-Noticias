

let formulario=document.getElementById('formulario-configuracion');
let inputDias=document.querySelector('[name="dias"]');
let inputTamaño=document.querySelector('[name="tamaño"]');

let enviar=document.querySelector('[name="guardar"]');

enviar.addEventListener('click', () =>{


      let valido=formulario.checkValidity();

      let errores=document.getElementById('errores-total');

      if(valido){
        valido.submit();
      }else{

        errores.innerHTML = "";

        if(inputDias.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar los días</div>`;
        }else if(inputDias.value <= 0){
            errores.innerHTML+=` <div class="alert alert-danger">Los días deben ser un número positivo</div>`;
        }

        if(inputTamaño.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar el tamaño</div>`;
        }

      }





      

})