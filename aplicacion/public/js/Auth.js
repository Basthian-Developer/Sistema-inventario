document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('miboton');

    if (button) {
        button.addEventListener('click', login);
    } else {
        console.warn('Error: El boton no existe');
    }
});

async function login() {
    try {
        const csrfValues = obtenerCsrf();

        const data = {
            username: document.getElementById('input_nombre').value,
            password: document.getElementById('input_pass').value,
            [csrfValues[0]]: csrfValues[1]
        }

        const response = await fetch('http://localhost:8080/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'include',
            body: JSON.stringify(data),
        });

        const result = await response.json();
        console.log(result.mensaje);
        
        const newCsrfToken = response.headers.get('X-CSRF-TOKEN');

        if (newCsrfToken) {
            document.querySelector('meta[name="csrf_token_value"]').setAttribute('content', newCsrfToken);
        }

        const mensaje = document.getElementById('mensaje-respuesta');

        if (result['status'] == 200) {
            mensaje.classList.remove('alert', 'alert-danger');
            mensaje.classList.add('alert', 'alert-success');
            mensaje.innerText = result['mensaje'];
            window.location.href = '/dashboard';
        } else {
            mensaje.classList.remove('alert-success');
            mensaje.classList.add('alert', 'alert-danger');
            mensaje.innerText = result['mensaje'];
        }
    } catch (error) {
        console.error("Error en la peticion: ", error);
    }
}
