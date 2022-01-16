<?php
         $key = $_GET['key']
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js"></script>
<script type="text/javascript" src="/firebase-messaging-sw.js"></script>
<div id="token"></div>
<script>
var Token = document.getElementById('token');
var firebaseConfig = {
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
            messaging
                .requestPermission()
                .then(function () {
                    console.log('Notification permission granted.');

                    // get the token in the form of promise
                    return messaging.getToken();
                })
                .then(function (token) {
                    Token.innerHTML = token;
                })
                .catch(function (err) {
                    console.log(err);
                });

            let enableForegroundNotification = true;
            messaging.onMessage(function (payload) {
              var data = payload.data.notification;
              var title = JSON.parse(data).title;
              console.log(title);
              navigator.serviceWorker
                        .getRegistrations()
                        .then((registration) => {
                            registration[0].showNotification(title);
                });
            });
</script>
<script type="text/javascript">
  
        Notification.requestPermission().then((status) => {
          console.log('Notification 상태', status);

          if (status === 'denied') {
            alert('Notification 거부됨');
          } else if (navigator.serviceWorker) {
            navigator.serviceWorker
              .register('/service-worker.js') // serviceworker 등록
              .then(function (registration) {
                const subscribeOptions = {
                  userVisibleOnly: true,
                  applicationServerKey: "BM_Ayo5D5H1E8ZmCVeJfw6_imVgIYvx7cDgrNJlOYtkkp09DavBX4qWwVcdHsfiWifZUFM6nXFU5j5yqrDxSdcw", // 발급받은 vapid public key
                };

                return registration.pushManager.subscribe(subscribeOptions);
              })
          }
        });

       function notify(text) {
            var code = document.getElementById('token').textContent;
            console.log(code);
            $.ajax({
              url: 'notification.php',
              method: 'POST',
              dataType: 'html',
              data: {device_code: code, data: text},
              success: function(result){
                  console.log(result);
              }
            })
       }
       function getAlarm(){
           var key = "<?=$key?>";
           $.ajax({
                 url: "getAlarm.php",
                 method: "post",
                 dataType: "html",
                 data: {data: key},
                 success: function(result){
            		if(result != "null"){
            			resetAlarm();
            			notify(result);
            		}
            		setTimeout(getAlarm(), 1000);
                 }
          })
        }
        function resetAlarm(){
        	var key = "<?=$key?>";
        	$.ajax({
        	   url: "resetAlarm.php",
        	   method: "POST",
                         dataType: "html",
                         data: {data: key},
                         success: function(result){
        		              console.log("success");
                         }
            })
                 }


        getAlarm();
</script>