document.addEventListener('DOMContentLoaded', () => {
    obtenerTabla();

    const btnExportar = document.getElementById('btnExportar');

    if(btnExportar){
        btnExportar.addEventListener('click', ExportarAuditoria);
    }
});

async function obtenerTabla() {
    try {
        const csrfValues = obtenerCsrf();

        const request = await fetch('tablas/obtenerAuditoria', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'include',
            body: JSON.stringify({[csrfValues[0]]: csrfValues[1]}),
        });

        if (!request.ok) {
            console.warn('Mensaje del sistema: Error al solicitar los datos de la auditoria');
            return;
        }

        const response = await request.json();
        
        if (response.status !== 200) {
            console.log('Mensaje del sistema: ', response.mensaje);
            return;
        }

        if (response.datos) {
            MostrarAuditoria(response);
        }
    } catch (e) {
        console.warn('Mensaje del sistema: Ocurrio un error al obtener los datos de auditoria');
    }
}

function MostrarAuditoria(data) {
    const tabla = document.getElementById('tablaAuditoria');

    if (!tabla) {
        console.warn('Mensaje del sistema: La tabla no existe');
    }

    const tbody = tabla.querySelector('tbody');
    tbody.innerHTML = '';

    data.datos.forEach(item => {
        const fila = document.createElement('tr');

        fila.innerHTML = `
            <td>${item.autor_auditoria}</td>
            <td>${item.mensaje_auditoria}</td>
            <td>${item.fecha_auditoria}</td>
        `;

        tbody.appendChild(fila);
    });
}

async function ExportarAuditoria(){
    try{
        const csrfValues = obtenerCsrf();

        const requestPython = await fetch('http://localhost:5000/datos_auditoria', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include'
        });

        if(!requestPython.ok){
            console.warn('Mensaje del sistema: No se pudo contactar con PYTHON');
            return;
        }

        const requestPHP = await fetch('tablas/exportarAuditoria', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include',
            body: JSON.stringify({[csrfValues[0]]: csrfValues[1]})
        });

        if(!requestPHP.ok){
            console.warn('Mensaje del sistema: Error al exportar la auditoria');
            return;
        }

        const response = await requestPHP.json();

        if(response.status !== 200){
            console.warn("Mensaje del sistema:", response.mensaje);
            return;
        }

        obtenerTabla();
        console.log("Mensaje del sistema:", response.mensaje);
    }catch(e){
        console.warn('Mensaje del sistema: Error en el script Table.js, funcion ExportarAuditoria');
        return;
    }
}