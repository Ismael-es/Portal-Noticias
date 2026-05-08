

let formulario=document.getElementById('formulario-EditarNoticia');
let inputTitulo=document.querySelector('[name="titulo"]');
let inputDescripcion=document.querySelector('[name="descripcion"]');
let inputEstado=document.querySelector('[name="estado"]');

let enviar=document.querySelector('[name="editarNoticia"]');

enviar.addEventListener('click', () =>{


      let valido=formulario.checkValidity();

      let errores=document.getElementById('errores-total');

      if(valido){
        valido.submit();
      }else{

        errores.innerHTML = "";

        if(inputTitulo.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar el título</div>`;
        }else if(inputTitulo.validity.tooShort || inputTitulo.validity.tooLong){
            errores.innerHTML+=` <div class="alert alert-danger">El título debe tener entre 10 y 100 caracteres</div>`;
        }

        if(inputDescripcion.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe ingresar la descripción</div>`;
        }else if(inputDescripcion.validity.tooShort){
            errores.innerHTML+=` <div class="alert alert-danger">La descripción debe tener al menos 50 caracteres</div>`;
        }


        if(inputEstado.validity.valueMissing){
            errores.innerHTML+=` <div class="alert alert-danger">debe seleccionar un estado inicial</div>`;
        }

      }





      

})