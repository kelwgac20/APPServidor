
const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');
const path = require('path');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));

app.post('/enviar', (req, res) => {
 const nombre = req.body.nombre;
 const destino = req.body.email;

 const transporter = nodemailer.createTransport({
   service: 'gmail',
   auth: {
     user: 'kelwgac20@gmail.com',
     pass: 'totqlmfbsgyakwaq',
   },
   tls: {
     rejectUnauthorized: false,
    }
   
 });

 const mailOptions = {
   from: 'tucorreo@gmail.com',
   to: destino,
   subject: 'Correo desde Node.js',
   text: `Hola ${nombre}, este correo fue enviado desde Express + Node.js.`,
 };

 transporter.sendMail(mailOptions, (error, info) => {
   if (error) {
     return res.send('Error al enviar: ' + error.message);
   }
   res.send('Correo enviado correctamente');
 });
});

app.listen(3000, () => {
 console.log('Servidor iniciado en http://localhost:3000');
});
