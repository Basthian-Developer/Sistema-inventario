document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('btnCerrarSesion');

    if (button) {
        button.addEventListener('click', logout);
    } else {
        console.warn("Error: El boton 'btnCerrarSesion' no existe");
    }
});

async function logout() {
    try {
        const csrfValues = obtenerCsrf();

        //const data = {
        //    [csrfName]: csrfValue
        //}

        const response = await fetch('auth/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'include',
            body: JSON.stringify(
                {
                    [csrfValues[0]]: csrfValues[1]
                }
            )
        });

        if (response.ok) {
            window.location.href = '/';
        }else{
            console.warn('Error: No se pudo cerrar la sesión');
        }
    } catch (e) {
        console.log('Error al cerrar sesión');
    }
}