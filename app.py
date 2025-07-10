import os
import random
import string
from datetime import datetime, timedelta
from flask import Flask, request, jsonify
from flask_mail import Mail, Message
import pymysql

app = Flask(__name__)

# --- Configuración de Flask-Mail ---
app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 587
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USERNAME'] = 'luisfeversantillancornelio@gmail.com'
app.config['MAIL_PASSWORD'] = 'luisfever'
app.config['MAIL_DEFAULT_SENDER'] = 'luisfeversantillancornelio@gmail.com'
mail = Mail(app)

# --- Configuración de la Base de Datos ---
DB_CONFIG = {
    'host': os.environ.get('DB_HOST', 'localhost'),
    'user': os.environ.get('DB_USER', 'root'),
    'password': os.environ.get('DB_PASSWORD', 'your_db_password'),  # Cambia esto por tu contraseña real
    'database': os.environ.get('DB_NAME', 'bdturismo'),
    'cursorclass': pymysql.cursors.DictCursor  # Para que todos los cursores devuelvan diccionarios
}

# --- Función para obtener conexión a la DB ---
def get_db_connection():
    try:
        conn = pymysql.connect(**DB_CONFIG)
        return conn
    except pymysql.MySQLError as err:
        print(f"Error al conectar a la base de datos: {err}")
        return None

# --- Función para generar un código de verificación ---
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
        return jsonify({'success': False, 'message': 'Error al conectar a la base de datos.'}), 500

    try:
        with conn.cursor() as cursor:
            code = generate_verification_code()
            expires_at = datetime.now() + timedelta(minutes=5)

            # Eliminar códigos anteriores
            cursor.execute("DELETE FROM email_verifications WHERE email = %s", (email,))
            conn.commit()

            # Insertar nuevo código
            insert_query = "INSERT INTO email_verifications (email, verification_code, expires_at, created_at) VALUES (%s, %s, %s, NOW())"
            cursor.execute(insert_query, (email, code, expires_at))
            conn.commit()

        # Enviar correo
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
                <p>Gracias por registrarte en nuestra aplicación. Usa el siguiente código para verificar tu correo:</p>
                <div class="code-box">
                    {code}
                </div>
                <p>Este código es válido por <strong>5 minutos</strong>.</p>
                <p>Saludos,<br>El equipo de Tu Aplicación</p>
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
        print(f"Error al procesar solicitud: {e}")
        return jsonify({'success': False, 'message': 'Error interno al enviar el código.'}), 500
    finally:
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
        return jsonify({'success': False, 'message': 'Error al conectar a la base de datos.'}), 500

    try:
        with conn.cursor() as cursor:
            select_query = "SELECT verification_code, expires_at FROM email_verifications WHERE email = %s ORDER BY created_at DESC LIMIT 1"
            cursor.execute(select_query, (email,))
            result = cursor.fetchone()

            if not result:
                return jsonify({'success': False, 'message': 'No se encontró un código válido.'}), 400

            stored_code = result['verification_code']
            expires_at = result['expires_at']

            if datetime.now() > expires_at:
                # Código expirado
                cursor.execute("DELETE FROM email_verifications WHERE email = %s AND verification_code = %s", (email, stored_code))
                conn.commit()
                return jsonify({'success': False, 'message': 'El código ha expirado.'}), 400

            if code_entered == stored_code:
                # Código válido
                cursor.execute("DELETE FROM email_verifications WHERE email = %s AND verification_code = %s", (email, stored_code))
                conn.commit()
                return jsonify({'success': True, 'message': 'Código validado correctamente.'})
            else:
                return jsonify({'success': False, 'message': 'Código incorrecto.'}), 400

    except Exception as e:
        print(f"Error al validar el código: {e}")
        return jsonify({'success': False, 'message': 'Error al validar el código.'}), 500
    finally:
        conn.close()

# --- Ejecutar la aplicación ---
if __name__ == '__main__':
    app.run(debug=True, port=5000)
# --- Fin del archivo app.py ---
