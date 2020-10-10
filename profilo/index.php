
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script src="scro.js"></script>
    <link rel="stylesheet" href="sly.css" />

    <title>Wed Portfolio</title>
  </head>
  <body>
    <main-header></main-header>
    <!-- todo: ใช้ComponentsจากJavaScript  ส่วนหัว-->

    <div class="content">
      <!--**ส่วนเนื้อหา-->
      <div class="container">
        <div class="contect-body">
          <div>
            <img src="img/me.jpg" class="md-avatar rounded" alt="" />
          </div>
          <div class="detail">
            <h6>HELLO EVERYBODY I'AM</h6>
            <h3>Krerkpon Siriwutthanpaitoon</h3>
            <h4>I Am Passionate programmer</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi,
              unde totam quidem blanditiis tempore possimus reiciendis vero
              asperiores maiores accusamus?
            </p>
            <a href="#" class="btn btn-primary" style="margin-left: 2rem;">MyWord</a>
            <a href="#" class="m-btn">Contact</a>
            <!--<ul class="basic_info">
              <li>
                <a href="#"
                  ><i class="fas fa-calendar-alt"></i> 31st December, 1992</a
                >
              </li>
              <li>
                <a href="#"><i class="fas fa-box"></i> 44 (012) 6954 783</a>
              </li>
              <li>
                <a href="#"
                  ><i class="fas fa-envelope"></i> businessplan@donald</a
                >
              </li>
              <li>
                <a href="#"
                  ><i class="fas fa-home"></i> Santa monica bullevard</a
                >
              </li>
            </ul>-->
          </div>
        </div>
        <!--??ส่วนสไลค์รูป-->
        <div id="demo" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0"></li>
            <li data-target="#demo" data-slide-to="1" class="active"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul>

          <!-- The slideshow -->
          <div class="carousel-inner"> <!--??StartContectSlie-->
          <div class="carousel-item">
              <div class="row">
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/people1.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">sdfd</h4>
                    <p class="card-text">
                      dsfsdf
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/people1.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">Krerkpon</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/people2.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">John Doe2</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="carousel-item  active">
              <div class="row">
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/me.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">Krerkpon</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/me.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">Krerkpon</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/w580.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">John Doe2</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="row">
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/people1.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">Krerkpon</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/people1.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">Krerkpon</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
                <div class="card col-4">
                  <div class="card-header">
                    <h3>ผลงาน</h3>
                  </div>
                  <img class="card-img-top" src="img/people2.jpg" alt="Card image" />
                  <div class="card-body">
                    <h4 class="card-title">John Doe2</h4>
                    <p class="card-text">
                      Some example text some example text. John Doe is an
                      architect and engineer
                    </p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                  </div>
                </div>
              </div>
            </div>

          </div><!--??contect end-->

          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="fas fa-arrow-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="fas fa-arrow-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!--??จบ-->
      </div>
    </div>
    
    <main-footer></main-footer>
  </body>
</html>
