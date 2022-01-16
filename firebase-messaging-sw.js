importScripts("https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js",
);
// For an optimal experience using Cloud Messaging, also add the Firebase SDK for Analytics.
importScripts(
    "https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js",
);

const firebaseConfig = {
  apiKey: "AIzaSyDSMqTJ1CL6CCm0oAceu2SxpgQeEsOg-FQ",
  authDomain: "push-notification-d1036.firebaseapp.com",
  projectId: "push-notification-d1036",
  storageBucket: "push-notification-d1036.appspot.com",
  messagingSenderId: "764481630394",
  appId: "1:764481630394:web:9dc058d5e75f44b6bb1283",
  measurementId: "G-V06X6Y92YV"
};

firebase.initializeApp(firebaseConfig);


const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    const data = payload.data.notification;
    const title = JSON.parse(data).title;
    const options = {
        body: ""
    };

    return self.registration.showNotification(
        title,
        options,
    );
});