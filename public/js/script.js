//funcion inmediatamente invocada
(function () {
    //todo lo declararo aqui es privado, ya que el ambito de vida d es el de la misma función
    var enlacesBorrar = document.getElementsByClassName('enlaceBorrar');
    
    for(var i = 0; i < enlacesBorrar.length; i++){
        
        enlacesBorrar[i].addEventListener('clik', getConfirmation());
    }
    
    function getConfirmation(){
        let id = event.target.dataset.id;
        var retVal = confirm("Sure to delete the enterprise number #"+id+'?');
        if(retVal){
          var formDelete = document.getElementById('formDelete');
          formDelete.action +='/'+id; 
          formDelete.submit();
        } 
    }
    
   /* function getConfirmation2(){
        alert("seguro que quieres borrar el ticket?");
        if(retVal){
          var formDelete = document.getElementById('formDelete');
          formDelete.submit();
        } 
    }^*/
})();