from flask import Flask, request, render_template
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
   if request.method == 'POST':
       nombre = request.form['nombre']
       destino = request.form['email']

       remitente = 'kelwgac20@gmail.com'
       password = 'totqlmfbsgyakwaq'  # sin espacios

       mensaje = MIMEMultipart()
       mensaje['From'] = remitente
       mensaje['To'] = destino
       mensaje['Subject'] = 'Correo enviado desde Flask'

       cuerpo = f'Hola {nombre}, este correo fue enviado desde un formulario en Flask.'
       #mensaje.attach(MIMEText(cuerpo, 'plain'))
       # Para que recoja caracteres especiales utf-8 como ñ
       mensaje.attach(MIMEText(cuerpo, 'plain', 'utf-8'))
       try:
           servidor = smtplib.SMTP('smtp.gmail.com', 587)
           servidor.starttls()
           servidor.login(remitente, password)
           servidor.sendmail(remitente, destino, mensaje.as_string())
           servidor.quit()
           return '✅ Correo enviado correctamente.'
       except Exception as e:
           return f'❌ Error al enviar el correo: {e}'

   return render_template('formulario.html');
# ... tu código anterior ...

if __name__ == "__main__":
   app.run(debug=True)