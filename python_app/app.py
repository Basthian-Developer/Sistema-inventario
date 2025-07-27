from flask import Flask, jsonify, send_file # type: ignore
from flask_cors import CORS  # type: ignore
import pandas as pd # type: ignore
from io import BytesIO
import mysql.connector # type: ignore
from datetime import datetime

app = Flask(__name__)
CORS(app, supports_credentials=True, origins=["http://localhost:8080"])

def obtener_datos_auditoria():
    cnx = mysql.connector.connect(
        user='app_user',
        password='app_pass',
        host='db',
        database='sistema_inventario'
    )
    cursor = cnx.cursor(dictionary=True)
    cursor.execute('call obtenerAuditoria()')
    resultados = cursor.fetchall()
    cursor.close()
    return resultados

@app.route('/datos_auditoria', methods=["POST"])
def datos_auditoria():
    datos = obtener_datos_auditoria()
    df = pd.DataFrame(datos)
    output = BytesIO()

    df = df.rename(columns={
        'id_auditoria': 'ID',
        'autor_auditoria': 'Autor',
        'mensaje_auditoria': 'Mensaje',
        'fecha_auditoria': 'Fecha'
    })

    fecha_actual = datetime.now().strftime('%Y-%m-%d_%H-%M-%S')
    nombre_archivo = f'documents/auditoria_{fecha_actual}.xlsx'
    with pd.ExcelWriter(nombre_archivo, engine='openpyxl') as writer:
        df.to_excel(writer, index=False, sheet_name='Auditoria')
    output.seek(0)
    return jsonify({"Mensaje":"Información exportada", "Codigo":200})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)