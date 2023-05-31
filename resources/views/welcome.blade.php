<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body>

  <table class=" table table-bordred filltable" width="50%">
    <thead><th>Name</th><th>Email</th></thead>
    <tbody> </tbody>
  </table>
  <span id="message"></span>
</body>
</html>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
filltable();
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('6b98db1f628e6a39a3e7', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('notification-send');
    channel.bind('my-event', function(data) {
     filltable();
    // $('#message').html(data.message);
    });

function filltable() {

   var table = $('.filltable').DataTable({
    destroy: true,
    pageLength: 50,
    searching: false,
    ajax: {
        url: "{{ route('user.show') }}",
    },
    columns: [
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'email',
            name: 'email'
        },

    ]
});

}
</script>