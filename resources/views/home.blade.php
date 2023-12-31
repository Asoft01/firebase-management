@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <button onclick="startFCM()"
                    class="btn btn-danger btn-flat">Allow notification
                </button>
            <div class="card mt-3">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('send.web-notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Message Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Message Body</label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{{-- <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script> --}}
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

<script>
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
  const messaging = firebase.messaging();

  
    function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("store.token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token stored.');
                    },
                    error: function (error) {
                        alert(error);
                    },
                });
            }).catch(function (error) {
                alert(error);
            });
    }
    messaging.onMessage(function (payload) {
        console.log(payload); return false;
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>
@endsection