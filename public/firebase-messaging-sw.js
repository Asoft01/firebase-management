// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
// firebase.initializeApp({
//     apiKey: "api-key",
//     authDomain: "auth-domian",
//     databaseURL: 'db-url',
//     projectId: "project-id",
//     storageBucket: "storage-bucket",
//     messagingSenderId: "message-sender-id",
//     appId: "app-id",
//     measurementId: "measurement-id"
// });
var firebaseConfig = {
    apiKey: "AIzaSyDPTsaEVEEzn1L20vJnl0lPqpDYAkDpyhc",
    authDomain: "laravel-firebase-68d9f.firebaseapp.com",
    projectId: "laravel-firebase-68d9f",
    storageBucket: "laravel-firebase-68d9f.appspot.com",
    messagingSenderId: "573279897636",
    appId: "1:573279897636:web:127e60ac3de45e82cab0b1",
    measurementId: "G-W9V6ZJRTBG"
};
firebase.initializeApp(firebaseConfig);

// const firebaseConfig = {
//     apiKey: "AIzaSyDPTsaEVEEzn1L20vJnl0lPqpDYAkDpyhc",
//     authDomain: "laravel-firebase-68d9f.firebaseapp.com",
//     projectId: "laravel-firebase-68d9f",
//     storageBucket: "laravel-firebase-68d9f.appspot.com",
//     messagingSenderId: "573279897636",
//     appId: "1:573279897636:web:127e60ac3de45e82cab0b1",
//     measurementId: "G-W9V6ZJRTBG"
//   };
  
//   // Initialize Firebase
//   const app = initializeApp(firebaseConfig);

//   const analytics = getAnalytics(app);
  
// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});