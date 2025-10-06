<?php
require_once "helpers.php";
start_session_once();


if (!isset($_SESSION['user'])) {
    header("Location: login_page.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <div style="background:#eee; padding:10px;">
    <?php if (!empty($_SESSION['user'])): ?>
      Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?> |
      <a href="logout.php">Logout</a>
    <?php else: ?>
     
    <?php endif; ?>
  </div>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Amul Dairy Home page</title>
    <link rel="stylesheet" href="index.css" />
    <style>
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: Arial, sans-serif;
      }
      #main {
        background: linear-gradient(
          180deg,
          rgba(144, 213, 254, 1) 10px,
          rgba(255, 255, 255, 1) 300px
        );
      }
      #footer {
        margin-top: auto;
      }
      #slider {
        width: 300px;
        height: 300px;
        overflow: hidden;
        position: relative;
        margin-top: 20px;
      }

      .slide {
        width: 100%;
        height: 100%;
        display: none;
      }

      #slider button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        font-size: 20px;
        padding: 8px 12px;
        cursor: pointer;
      }

      #prev {
        left: 0;
      }
      #next {
        right: 0;
      }
    </style>

    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div id="header"></div>

    <div id="main">
      <h1>Welcome to Amul- The Test Of India</h1>
      <div id="content">
        <div class="left-box">
          <div class="carousel">
            <input type="radio" name="slider" id="img1" checked />
            <input type="radio" name="slider" id="img2" />
            <input type="radio" name="slider" id="img3" />

            <div class="images">
              <div class="image" id="i1">
                <label for="img2"
                  ><img src="banner1.png" alt="Image 1"
                /></label>
              </div>
              <div class="image" id="i2">
                <label for="img3"
                  ><img src="banner2.png" alt="Image 2"
                /></label>
              </div>
              <div class="image" id="i3">
                <label for="img1"
                  ><img src="banner3.png" alt="Image 3"
                /></label>
              </div>
            </div>
          </div>
        </div>
        <div class="right-box">
          <div class="gallery">
            <input type="radio" name="slide" id="imgA" checked />
            <input type="radio" name="slide" id="imgB" />
            <input type="radio" name="slide" id="imgC" />
            <input type="radio" name="slide" id="imgD" />
            <input type="radio" name="slide" id="imgE" />

            <div class="photo-container">
              <div class="photoA">
                <label for="imgB"><img src="b1.png" alt="Image A" /></label>
              </div>
              <div class="photoB">
                <label for="imgC"><img src="b2.png" alt="Image B" /></label>
              </div>
              <div class="photoC">
                <label for="imgD"><img src="b3.png" alt="Image C" /></label>
              </div>
              <div class="photoD">
                <label for="imgE"><img src="b4.png" alt="Image D" /></label>
              </div>
              <div class="photoE">
                <label for="imgA"><img src="b5.png" alt="Image E" /></label>
              </div>
            </div>
          </div>

          <div id="slider">
            <img src="amul shakti.jpeg" class="slide" style="display: block" />
            <img src="amul cow milk.png" class="slide" />
            <img src="amul gold.jpeg" class="slide" />
            <button id="prev">❮</button>
            <button id="next">❯</button>
          </div>
        </div>
      </div>
    </div>

    <div id="footer"></div>

    <script>
      let currentSlide = 0;
      const slides = document.querySelectorAll(".slide");

      function showSlide(index) {
        slides.forEach((slide, i) => {
          slide.style.display = i === index ? "block" : "none";
        });
      }

      document.getElementById("next").onclick = () => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
      };

      document.getElementById("prev").onclick = () => {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
      };
      fetch("header.php")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("header").innerHTML = data;
        });

      fetch("footer.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("footer").innerHTML = data;
        });
    </script>
  </body>
</html>
