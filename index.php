<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Send Files</title>
  <!-- Latest compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> -->

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    .hero {
      height: 100%;
      width: 100%;
      background: #000;
      background-position: center;
      background-size: cover;
      position: absolute;

    }

    .form-box {
      width: 400px;
      height: 500px;
      position: relative;
      margin: 6% auto;
      background: #fff;
      padding: 5px;
      overflow: hidden;
    }

    .button-box {
      width: 300px;
      margin: 35px auto;
      position: relative;
      left: 40px;
      box-shadow: 0 0 20px 9px #fff8;
      border-radius: 30px;
    }

    .toggle-btn {
      padding: 10px 20px;
      cursor: pointer;
      background: transparent;
      border: 0;
      outline: none;
      position: relative;
    }

    #btn {
      top: 0;
      left: 0;
      position: absolute;
      width: 110px;
      height: 100%;
      background: #ff6600;
      border-radius: 30px;
      transition: .5s;
    }

    .input-group {
      top: 150px;
      position: absolute;
      width: 280px;
      transition: .5s;
    }

    #file {
      left: 50px;
    }

    #code {
      left: 450px;
    }
  </style>
</head>

<body>

  <div class="hero">
    <div class="form-box">
      <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="file()">Send File</button>
        <button type="button" class="toggle-btn" onclick="code()">Send Code</button>

      </div>
      <p>
        <?php
        if (isset($_SESSION['msg'])) {
          
           ?>
                <script>
                    swal({
                        title: "Sent!",
                        text: "<?php echo $_SESSION['msg'];    ?>",
                        icon: "success",
                        button: "ok"
                    });
                </script>
            <?php
          session_unset();
        }

        ?>
      </p>
      <form method="post" action="sendmail.php" enctype="multipart/form-data" class="input-group" id="file">
        <div class="container-sm">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="name@example.com" required />
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Subject</label>
            <input type="text" class="form-control" name="subject" placeholder="subject name" required />
          </div>

          <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Select files</label>
            <input class="form-control" type="file" name="attachment[]" multiple required />
          </div>


          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" name="send" value="submit">
              Submit
            </button>
          </div>
        </div>
      </form>

      <form method="post" action="sendmail.php" enctype="multipart/form-data" id="code" class="input-group">
        <div class="container-sm">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="name@example.com" required />
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Subject</label>
            <input type="text" class="form-control" name="subject" placeholder="subject name" required />
          </div>

          <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Paste Your Code</label>
            <textarea class="form-control" name="code"></textarea>
          </div>


          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" name="submit" value="submit">
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>






  <script>
    var x = document.getElementById("file");
    var y = document.getElementById("code");
    var z = document.getElementById("btn");


    function code() {
      x.style.left = "-400px";
      y.style.left = "50px";
      z.style.left = "110px";
    }

    function file() {
      x.style.left = "50px";
      y.style.left = "450px";
      z.style.left = "0px";
    }
  </script>



  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

</body>

</html>