<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>One Health - Medical Center HTML5 Template</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">



</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

 @include('user.navbar')

  <div class="container">
    @if(session()->has('message'))
        
    <div class="alert alert-success"  style="margin-top:20px; text-align:center;">
  
    {{session()->get('message')}}
  </div>
  @endif
</div>
  <div class="container">
<table class="table">
    <thead>
      <tr>
        <th scope="col">Doctor name</th>
        <th scope="col">Date</th>
        <th scope="col">Message</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($appo as $appointment)
        <tr> 
            <td>{{$appointment->doctor}}</td>
            <td>{{$appointment->date}}</td>
            <td>{{$appointment->message}}</td>
            <td>{{$appointment->status}}</td>
            <td><a class="btn btn-danger" href="{{url('delete_apt', $appointment->id)}}">Delete</a></td>
            
          </tr>
        @endforeach
      
    </tbody>
  </table>

</div>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>


  
</body>
</html>