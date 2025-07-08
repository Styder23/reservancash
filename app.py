import os
import random
import string
from datetime import datetime, timedelta
from flask import Flask, request, jsonify
from flask_mail import Mail, Message
import mysql.connector # O 'pymysql' si lo prefieres

app = Flask(__name__)

# --- Configuración de Flask-Mail (mantener igual) ---
app.config['MAIL_SERVER'] = os.environ.get('MAIL_SERVER', 'smtp.gmail.com')
app.config['MAIL_PORT'] = int(os.environ.get('MAIL_PORT', 587))
app.config['MAIL_USE_TLS'] = os.environ.get('MAIL_USE_TLS', 'True').lower() == 'true'
app.config['MAIL_USE_SSL'] = os.environ.get('MAIL_USE_SSL', 'False').lower() == 'true'
app.config['MAIL_USERNAME'] = os.environ.get('MAIL_USERNAME', 'tu_correo@gmail.com')
app.config['MAIL_PASSWORD'] = os.environ.get('MAIL_PASSWORD', 'tu_contraseña_de_aplicacion')
app.config['MAIL_DEFAULT_SENDER'] = os.environ.get('MAIL_DEFAULT_SENDER', 'tu_correo@gmail.com')
mail = Mail(app)

# --- Configuración de la Base de Datos ---
# ¡IMPORTANTE! Reemplaza con tus credenciales reales o variables de entorno
DB_CONFIG = {
    'host': os.environ.get('DB_HOST', 'localhost'),
    'user': os.environ.get('DB_USER', 'root'),
    'password': os.environ.get('DB_PASSWORD', 'your_db_password'), # Tu contraseña de DB
    'database': os.environ.get('DB_NAME', 'bdturismo')
}

# --- Función para obtener conexión a la DB ---
def get_db_connection():
    try:
        conn = mysql.connector.connect(**DB_CONFIG)
        return conn
    except mysql.connector.Error as err:
        print(f"Error al conectar a la base de datos: {err}")
        return None

# --- Función para generar un código al azar de 6 dígitos (mantener igual) ---
def generate_verification_code():
    return ''.join(random.choices(string.digits, k=6))

# --- Ruta para enviar el código de verificación ---
@app.route('/send-verification-code', methods=['POST'])
def send_verification_code():
    data = request.get_json()
    email = data.get('email')

    if not email:
        return jsonify({'success': False, 'message': 'Email no proporcionado.'}), 400

    conn = get_db_connection()
    if conn is None:
        return jsonify({'success': False, 'message': 'Error interno del servidor al conectar con la base de datos.'}), 500

    try:
        cursor = conn.cursor()
        code = generate_verification_code()
        expires_at = datetime.now() + timedelta(minutes=5)

        # Eliminar códigos antiguos para este email antes de insertar uno nuevo
        cursor.execute("DELETE FROM email_verifications WHERE email = %s", (email,))
        conn.commit()

        # Insertar el nuevo código en la base de datos
        insert_query = "INSERT INTO email_verifications (email, verification_code, expires_at) VALUES (%s, %s, %s)"
        cursor.execute(insert_query, (email, code, expires_at))
        conn.commit()

        # Enviar el correo (la lógica del correo se mantiene igual)
        msg = Message('Código de Verificación - Tu Aplicación',
                      sender=app.config['MAIL_DEFAULT_SENDER'],
                      recipients=[email])
        msg.html = f"""
        <html>
        <head>
            <style>
                body {{ font-family: Arial, sans-serif; line-height: 1.6; color: #333; }}
                .container {{ width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }}
                .header {{ background-color: #007bff; color: white; padding: 10px 20px; border-radius: 8px 8px 0 0; text-align: center; }}
                .code-box {{ background-color: #e9ecef; padding: 15px; border-radius: 5px; text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0; letter-spacing: 3px; }}
                .footer {{ margin-top: 20px; font-size: 0.9em; color: #777; text-align: center; }}
                a {{ color: #007bff; text-decoration: none; }}
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h2>Verificación de Correo Electrónico</h2>
                </div>
                <p>Hola,</p>
                <p>Gracias por registrarte en nuestra aplicación. Para completar tu verificación, por favor, usa el siguiente código:</p>
                <div class="code-box">
                    {code}
                </div>
                <p>Este código es válido por **5 minutos**. Si no solicitaste este código, puedes ignorar este correo.</p>
                <p>Saludos cordiales,<br>El equipo de Tu Aplicación</p>
                <div class="footer">
                    <p>&copy; {datetime.now().year} Tu Aplicación. Todos los derechos reservados.</p>
                </div>
            </div>
        </body>
        </html>
        """

        mail.send(msg)
        return jsonify({'success': True, 'message': 'Código enviado exitosamente.'})

    except Exception as e:
        print(f"Error al enviar correo o guardar en DB: {e}")
        return jsonify({'success': False, 'message': 'Error al procesar la solicitud de verificación.'}), 500
    finally:
        if conn:
            cursor.close()
            conn.close()

# --- Ruta para validar el código de verificación ---
@app.route('/validate-verification-code', methods=['POST'])
def validate_verification_code():
    data = request.get_json()
    email = data.get('email')
    code_entered = data.get('code')

    if not email or not code_entered:
        return jsonify({'success': False, 'message': 'Email o código no proporcionado.'}), 400

    conn = get_db_connection()
    if conn is None:
        return jsonify({'success': False, 'message': 'Error interno del servidor al conectar con la base de datos.'}), 500

    try:
        cursor = conn.cursor(dictionary=True) # Usamos dictionary=True para obtener resultados como diccionarios
        select_query = "SELECT verification_code, expires_at FROM email_verifications WHERE email = %s ORDER BY created_at DESC LIMIT 1"
        cursor.execute(select_query, (email,))
        stored_code_info = cursor.fetchone()

        if not stored_code_info:
            return jsonify({'success': False, 'message': 'No hay código de verificación para este email o ya expiró.'}), 400

        stored_code = stored_code_info['verification_code']
        expires_at = stored_code_info['expires_at']

        if datetime.now() > expires_at:
            # Si el código ha expirado, lo eliminamos de la DB
            delete_query = "DELETE FROM email_verifications WHERE email = %s AND verification_code = %s"
            cursor.execute(delete_query, (email, stored_code))
            conn.commit()
            return jsonify({'success': False, 'message': 'El código de verificación ha expirado.'}), 400

        if code_entered == stored_code:
            # Código válido y no expirado. Lo eliminamos de la DB después de usarlo.
            delete_query = "DELETE FROM email_verifications WHERE email = %s AND verification_code = %s"
            cursor.execute(delete_query, (email, stored_code))
            conn.commit()
            return jsonify({'success': True, 'message': 'Código validado correctamente.'})
        else:
            return jsonify({'success': False, 'message': 'Código de verificación incorrecto.'}), 400

    except Exception as e:
        print(f"Error al validar código en DB: {e}")
        return jsonify({'success': False, 'message': 'Error interno del servidor al validar el código.'}), 500
    finally:
        if conn:
            cursor.close()
            conn.close()

# --- Ejecutar la aplicación Flask (mantener igual) ---
if __name__ == '__main__':
    app.run(debug=True, port=5000)