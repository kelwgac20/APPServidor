#archivo enviar_correo.py
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# Credenciales
remitente = "kelwgac20@gmail.com"
contrasena_app = "totqlmfbsgyakwaq"  # Contraseña de aplicación (sin espacios)
destinatario = "kelwgac20@yahoo.com"

# Crear mensaje
mensaje = MIMEMultipart()
mensaje["From"] = remitente
mensaje["To"] = destinatario
mensaje["Subject"] = "Correo de prueba con Python"

cuerpo = "Hola, este correo fue enviado desde Python puro usando Gmail y contraseña de aplicación."
mensaje.attach(MIMEText(cuerpo, "plain"))

try:
   # Configurar servidor SMTP
   servidor = smtplib.SMTP("smtp.gmail.com", 587)
   servidor.starttls()
   servidor.login(remitente, contrasena_app)
   servidor.sendmail(remitente, destinatario, mensaje.as_string())
   servidor.quit()
   print("✅ Correo enviado correctamente.")
except Exception as e:

   print("❌ Error al enviar el correo:", e) 