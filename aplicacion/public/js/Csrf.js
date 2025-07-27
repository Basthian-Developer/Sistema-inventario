function obtenerCsrf(){
    try{
        csrfToken = document.querySelector('meta[name="csrf_token_name"]').getAttribute('content');
        csrfHash = document.querySelector('meta[name="csrf_token_value"]').getAttribute('content');
        return [csrfToken, csrfHash];
    }catch(e){
        console.error('Error al obtener el CSRF:',e);
        return null;
    }
}