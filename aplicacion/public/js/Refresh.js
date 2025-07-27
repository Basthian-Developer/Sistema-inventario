let tokenintervalo = null;

document.addEventListener('DOMContentLoaded', () => {
    renovarAccesToken();
});

function renovarAccesToken() {
    if (tokenintervalo !== null) return;

    const intervalo = 8 * 60 * 1000;

    const ejecutarRenovacion = async () => {
        try {
            const csrfValues = obtenerCsrf();

            if (!csrfValues[0] || !csrfValues[1]) {
                console.warn('CSRF no disponible');
                return;
            }

            const response = await fetch('auth/renovar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                credentials: 'include',
                body: JSON.stringify(
                    { [csrfValues[0]]: csrfValues[1] }
                )
            });

            const data = await response.json();

            if(data.status !== 200){
                clearInterval(tokenintervalo);
                console.log(data.mensaje);
            }

            console.log("Mensaje del sistema:",data.mensaje);
        }catch(e){
            console.warn('Error al renovar:', e);
        }
    };

    ejecutarRenovacion();
    tokenintervalo = setInterval(ejecutarRenovacion, intervalo);
}