<html>

<head>
  <script src="peerjs.js"></script>
  <!-- <script src="https://unpkg.com/peerjs@1.3.2/dist/peerjs.min.js"></script> -->

  <script src="jquery.min.js"></script>
</head>

<body>
  <div>
    <input id="cid" name="cid" value="" placeholder="my id" />
    <br>
    <input id="did" name="did" value="" placeholder="dest id" />
    <br>
    <button onclick="start_connection()">Start connection</button>
    <br>
    <textarea id="mes-box" name="mes-box"></textarea>
    <button onclick="send_message()">send message</button>
    <br>
    <div id="res-box"></div>
    <button onclick="askNotificationPermission()" id="enable">Enable notifications</button>
    <button onclick="showNotification()">Send notifications</button>
    <button onclick="call()">Call</button>
    <video width="300" height="225" id="my-vid-box" autoplay></video>
    <div></div>
    <video width="300" height="225" id="vid-box" autoplay></video>
  </div>
  <script>
    function getRndInteger(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    var peer = new Peer(getRndInteger(1, 1000));
    peer.on('open', function(id) {
      console.log('My peer ID is: ' + id);
      $('#cid').val(id);
    });

    let conn;

    function start_connection() {
      conn = peer.connect($('#did').val());
      conn.on("open", () => {
        conn.send("hi!");
        console.log("hi!");
        conn.on('data', function(data) {
          console.log('3')
          $('#res-box').append('<div>' + data + '</div>');
        });
      });
      conn.on("close", () => {
        console.log('conn close');
      });
      conn.on("error", (err) => {
        console.log('conn close');
        console.log(err);
      });
    }

    function send_message() {
      conn.send($('#mes-box').val());
    }


    peer.on("connection", (conn1) => {
      if (conn) {

      } else {
        conn = conn1;
      }
      console.log(conn1);

      conn1.on("data", (data) => {
        console.log(data);
        $('#res-box').append('<div>' + data + '</div>');
      });
      conn1.on("close", () => {
        console.log('conn close');
      });
      conn1.on("error", (err) => {
        console.log('conn close');
        console.log(err);
      });
    });

    peer.on("close", () => {
      console.log("close peer");
    });

    peer.on("disconnected", () => {
      console.log("disconnected peer");
    });

    peer.on("error", (err) => {
      console.log("error peer");
      console.log(err);
    });

    const video = document.getElementById('my-vid-box');
    video.autoplay = true;


    const remote_video = document.getElementById('vid-box');
    remote_video.autoplay = true;

    const stream_1 = null;

    function call() {
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
          video: true,
          audio: true
        }).then(function(stream) {
          // stream_1=stream;
          video.srcObject = stream;
          //video.play();
          const call = peer.call($('#did').val(), stream);


          call.on("stream", (stream) => {
            video.srcObject = stream;
            //video.play();
            // Show stream in some <video> element.
          });
        });
      }
    }

    peer.on("call", (call) => {
      console.log('calling');
      // call.answer(video.srcObject); 
      // call.on("stream", (remoteStream) => {
      //   console.log('calling');
      //  // video.play();
      //   remote_video.srcObject = remoteStream;

      //  // remote_video.play();

      //   // Show stream in some <video> element.
      // });
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
          video: true,
          audio: true
        }).then(function(stream) {
          call.answer(stream); // Answer the call with an A/V stream.
          call.on("stream", (remoteStream) => {
            remote_video.srcObject = remoteStream;
            remote_video.play();
            // Show stream in some <video> element.
          });
        });
      }
    });

    function askNotificationPermission() {
      // function to actually ask the permissions
      function handlePermission(permission) {
        // set the button to shown or hidden, depending on what the user answers
        // notificationBtn.style.display =
        //   Notification.permission === 'granted' ? 'none' : 'block';
      }

      // Let's check if the browser supports notifications
      if (!('Notification' in window)) {
        console.log("This browser does not support notifications.");
      } else if (checkNotificationPromise()) {
        Notification.requestPermission().then((permission) => {
          handlePermission(permission);
        });
      } else {
        Notification.requestPermission((permission) => {
          handlePermission(permission);
        });
      }
    }

    function checkNotificationPromise() {
      try {
        Notification.requestPermission().then();
      } catch (e) {
        return false;
      }

      return true;
    }

    function send_notification() {
      if (checkNotificationPromise()) {
        const img = 'icon.png';
        const text = `HEY! Notiffication.`;
        const notification = new Notification('To do list', {
          body: text,
          icon: img
        });
      } else {
        alert('not permission');
      }

    }

    navigator.serviceWorker.register('sw.js');

    function showNotification() {
      Notification.requestPermission((result) => {
        if (result === 'granted') {
          navigator.serviceWorker.ready.then((registration) => {
            registration.showNotification('Vibration Sample', {
              body: 'Buzz! Buzz!',
              icon: 'icon.png',
              vibrate: [200, 100, 200, 100, 200, 100, 200],
              tag: 'vibration-sample'
            });
          });
        }
      });
    }
  </script>
</body>

</html>