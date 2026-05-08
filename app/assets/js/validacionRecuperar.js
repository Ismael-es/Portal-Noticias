//valdiacon del recuperar contraseña mail


let formulario=document.getElementById('formulario-recuperar');

let inputMail=document.querySelector('[name="mail"]');

let enviar=document.querySelector('[name="enviarRecuperacion"]');

enviar.addEventListener('click', () =>{


        let valido=formulario.checkValidity();

        let errores=document.getElementById('errores-total');

        if(valido){
            formulario.submit();
        }else{
            errores.innerHTML = "";

            if(inputMail.validity.valueMissing){
                errores.innerHTML+=` <div class="alert alert-danger">debe ingresar el mail</div>`;
            }

        }


})