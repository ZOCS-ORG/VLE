 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>ZOCS Landing Page</title>

</head>
<body>
<?php include ('./nav.php') ?>

<div class="slider">
    <div id="carouselExampleCaptions" class="carousel slide carousel-container" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./Images/0.93911200_1662368738_africa.jpg" class="d-block w-100" alt="...">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-item">
                <img src="./Images/img_7589.jpg" class="d-block w-100" alt="...">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-item">
                <img src="./Images/pov5.jpg" class="d-block w-100" alt="...">
                <div class="carousel-overlay"></div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<script>
    // Activate the carousel with autoplay
    var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleCaptions'), {
        interval: 1000, 
        pause: 'hover' 
    });
</script>

<div class="socials">
  <h2 class="text-center" style ="color: #198754;
    border-bottom: #198754 6px double ; width:40%; margin-left:auto; margin-right:auto;">Socials</h2>
    <br>
  <div class="row justify-content-center mt-4">
    <div class="col-md-5 social-column">
      <a class="twitter-timeline" data-width="500" data-height="400" data-dnt="true" data-theme="light" href="https://twitter.com/open_zocs?ref_src=twsrc%5Etfw">Tweets by open_zocs</a>
      <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
    <div class="col-md-5 social-column">
    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FZocsZambiaOpenCommunitySchool&tabs=timeline%2C%20events&width=500&height=400&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="400" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
    </div>
  </div>
</div>


<div class="About mt-4 mb-2 text-center"> 
  <h2>About VLE</h2>
  <p class="">Action on Early Childhood Development and Education in Eastern and Southern Africa has been driven by civil society and governments based on international treaties and declarations on Early Childhood Development and Education (ECDE) (UNESCO, 2007). The more recent Sustainable Development Goals (SDG) target 4.2, underlines the need for “all boys and girls to have access to early childhood development, care and pre-primary education so that they are ready for primary education.”
<br>
<strong>Key Challenges:</strong>
<ol>
    <li style="text-align:justify;"><strong>Lack of stakeholder coordination:</strong> The roles that parents, teachers, school administrations, and the community should play in ensuring school readiness and transition from pre-primary to primary school are not coordinated. In Zambia, the Transition Management implementation guidelines (2021) were developed but have not implemented yet. Uganda has not yet developed any guidelines in this regard.</li>
    <li style="text-align:justify;"><strong>Inadequate school readiness and transition due to limited access to ECDE:</strong> It is estimated that only 6% of Zambian children between the ages of three and six attend pre-schools, and 76% of children starting primary school have no ECDE experience (Educational Statistical Bulletin of 2016). In Uganda, in 2016, only 563,913 learners accessed pre-primary education in the registered 6,798 pre-primary schools of which 284,824 (50.5%) were girls (NPA, 2020). Limited access to ECDE has implications for equity and inclusion, especially among marginalized and rural communities.</li>
    <li style="text-align:justify;"><strong>Inadequate PBL pedagogical practices among teachers and inappropriate learning environments:</strong> Teaching through play is favored for pre-primary and early grades in primary schools. However, teachers have inadequate skills, knowledge, and attitudes to implement play approaches (Early learning development standards for Zambia, 2016). The school environments, including physical conditions and facilities, are usually not age-appropriate (Early learning development standards for Zambia, 2016).</li>
    <li style="text-align:justify;"><strong>Lack of trained and certified teachers in ECDE:</strong> In both Uganda and Zambia, the governments have only recently been involved in the training of ECED teachers. As a result, volunteers without knowledge and skills assume the responsibility of teaching ECDE children.</li>
</ol>
</p>
</div>

</div> 
<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
        <p>&copy; 2024 ZOCS. All rights reserved.</p>
        <p>Address: P.O Box 50429 | Lusaka</p>
        <p>Contact: Phone: (+260) 211-253641 / 211-253656</p>
        <p>Powered by Chesco tech-ltd</p>
    </footer>
</html>


