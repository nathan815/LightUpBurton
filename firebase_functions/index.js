/**
 * Contact form email notification
 */

'use strict';

const functions = require('firebase-functions');
const nodemailer = require('nodemailer');
const gmailEmail = encodeURIComponent(functions.config().gmail.email);
const gmailPassword = encodeURIComponent(functions.config().gmail.password);
const mailTransport = nodemailer.createTransport(
    `smtps://${gmailEmail}:${gmailPassword}@smtp.gmail.com`);

// Sends an email when contact form is submitted
exports.contactFormSendEmail = functions.database.ref('/contact/{id}').onWrite(event => {
  const snapshot = event.data;
  const val = snapshot.val();

  console.log('Contact form submitted by: ' + val.email);

  const mailOptions = {
    from: '"LightUpBurton.com" <nathancj224@gmail.com>',
    replyTo: val.email,
    to: 'nathancj224@gmail.com'
  };

  mailOptions.subject = 'LightUpBurton.com Contact Form [#' + val.timestamp +']';
  mailOptions.text = 'Someone has submitted the contact form on LightUpBurton.com: \n\n' +
  'Name: ' + val.name + '\n' +
  'Email: ' + val.email + '\n' +
  'Message: \n' + val.message + '\n';
  return mailTransport.sendMail(mailOptions).then(() => {
    console.log('Contact form email has been sent.');
  });

});