const nodemailer = require('nodemailer');
 
// Configurar el transporte SMTP de Gmail
const transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: 'kelwgac20@gmail.com', // tu Gmail
    pass: 'totqlmfbsgyakwaq', // contraseña de aplicación generada
  },
});
 
// Configurar el mensajen
const mailOptions = {
  from: 'kelwgac20@gmail.com',
  to: 'destinatario@ejemplo.com',
  subject: 'Correo de prueba desde Node.js',
  text: 'Hola! Este correo fue enviado desde Node.js usando Gmail y contraseña de aplicación.',
};
 
// Enviar el correo
transporter.sendMail(mailOptions, (error, info) => {
  if (error) {
    return console.log('Error:', error);
  }
  console.log('Correo enviado:', info.response);
});