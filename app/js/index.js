var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        localStorage.setItem('device', device.platform);
        
        app.receivedEvent('deviceready');
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
        console.log('Received Event: ' + id);

        var push = PushNotification.init({ 
            "android": {
                "senderID": "704684993819"
            }
        });
        
        push.on('registration', function(data) {
            console.log(data.registrationId);
            window.localStorage.setItem("registrationId", data.registrationId);
        });

        push.on('notification', function(data) {
            alert(data.message);
        });

        push.on('error', function(e) {
            alert(e);
        });
    }
};

app.initialize();

