/**
 * Copyright 2015 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
'use strict';

const functions = require('firebase-functions');
const nodemailer = require('nodemailer');
// Configure the email transport using the default SMTP transport and a GMail account.
// For other types of transports such as Sendgrid see https://nodemailer.com/transports/
// TODO: Configure the `gmail.email` and `gmail.password` Google Cloud environment variables.
const gmailEmail = encodeURIComponent(functions.config().gmail.email);
const gmailPassword = encodeURIComponent(functions.config().gmail.password);
const mailTransport = nodemailer.createTransport(
    `smtps://${gmailEmail}:${gmailPassword}@smtp.gmail.com`);

// Sends an email confirmation when a user changes his mailing list subscription.
exports.sendEmail = functions.database.ref('/contact/{id}').onWrite(event => {
  const snapshot = event.data;
  const val = snapshot.val();

  const mailOptions = {
    from: '"LightUpBurton.com" <nathancj224@gmail.com>',
    replyTo: val.email,
    to: 'nathancj224@gmail.com'
  };

  var text = 'Someone has submitted the contact form on LightUpBurton.com: \n\n' +
  'Name: ' + val.name + '\n' +
  'Email: ' + val.email + '\n' +
  'Message: \n' + val.message + '\n';

  mailOptions.subject = 'LightUpBurton.com Contact Form [#' + val.timestamp +']';
  mailOptions.text = text;
  return mailTransport.sendMail(mailOptions).then(() => {
    console.log('Sent message');
  });

});