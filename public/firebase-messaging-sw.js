importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyBL85bbwYvY3shOonPDdzjIrhAkY6YAf_U",
    authDomain: "new-tekya.firebaseapp.com",
    projectId: "new-tekya",
    storageBucket: "new-tekya.appspot.com",
    messagingSenderId: "1011536605149",
    appId: "1:1011536605149:web:ced524c048058ee9581034",
    measurementId: "G-26N33S5JB6"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});