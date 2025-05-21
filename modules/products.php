<style>
.navbar-vertical {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    background-color: #9b806e !important;
}

.navbar-nav {
    overflow-y: auto;
    scrollbar-width: thin;
}

.navbar-nav::-webkit-scrollbar {
    width: 5px;
}

.navbar-nav::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 10px;
}

.nav-item.nav-link,
.nav-item.dropdown .nav-link {
    padding: 0.75rem 1.5rem;
    color: white !important;
    font-weight: 500;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    transition: all 0.2s ease;
}

.nav-item.nav-link:hover,
.nav-item.dropdown:hover .nav-link {
    color: white !important;
    background-color: rgba(0, 0, 0, 0.1) !important;
}

.nav-item.dropdown .nav-link i {
    transition: transform 0.3s ease;
    color: rgba(255, 255, 255, 0.7) !important;
}

.nav-item.dropdown.show .nav-link i {
    transform: rotate(180deg);
}

.catbtn {
    background-color: #9b806e !important;
    transition: background-color 0.3s ease;
}

.catbtn:hover {
    background-color: #7a5b4e !important;
    text-decoration: none;
}

.dropdown-menu {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
    background-color: #9b806e !important;
    border: none !important;
}

.dropdown-item {
    padding: 0.5rem 1.5rem;
    color: white !important;
    transition: all 0.2s ease;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.dropdown-item:hover {
    color: white !important;
    background-color: rgba(0, 0, 0, 0.1) !important;
}

.nav-item.nav-link.active {
    color: white !important;
    background-color: rgba(0, 0, 0, 0.2) !important;
    border-left: 3px solid white !important;
}

@media (max-width: 991.98px) {
    .navbar-vertical {
        position: absolute;
        z-index: 1000;
        width: 100%;
    }
    
    .navbar-nav {
        max-height: 300px;
    }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.dropdown-menu {
    animation: fadeIn 0.3s ease forwards;
}

.cardcontainer {
display: flex;
justify-content: space-between;
padding: 20px;
}

.section {
    background: #FFFFFF;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    flex: 1;
    margin: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.explorebtn {
    background-color: #CEC4C2;
    letter-spacing: 1px;
    color: white;
    border: 1px solid #A39594;
    border-radius: 10px;
    padding: 10px 20px;
    margin: -1px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.explorebtn:hover {
    box-shadow: 0 4px 15px rgba(255, 233, 191, 0.8);
}

.carousel-item {
    height: 100%;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner_title {
    position: absolute;
    bottom: 20px;
    left: 60px;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.3);
    padding: 20px;
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
}

.row {
    display: flex;
}

.banner_title:hover {
  transform: translate(45px, 0px) scale(1.05);
  transition: transform 0.3s ease-in-out;
}

.bike_text {
    color: #44443B;
    font-size: 45px;
    font-weight: bold;
    margin: 0;
    text-shadow: 0.75px 0.75px 1px #EC7A1C;
}

.subtext {
    font-size: 16px;
    margin: 0;
    padding-bottom: 30px;
}

.buttonbutton {
    width: 170px;
}

.buttonbutton button {
    background: #f0f0f0;
    padding: 10px;
    display: inline-block;
    outline: 0;
    margin: -1px;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: 1px; 
    width: 100%;
    border: 1px solid #A39594;
    cursor: pointer;
}

.buttonbutton button:hover {
    box-shadow: 0 4px 15px rgba(255, 233, 191, 0.35);
}

#main_slider {
    width: 100%;
    height: 410px;
    overflow: hidden;
    margin-left: 20px;
}


#main_slider a.carousel-control-next,
#main_slider a.carousel-control-prev {
    width: 45px;
    height: 45px;
    background: #fff;
    opacity: 0.5;
    font-size: 30px;
    color: #333333;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
}

#main_slider a.carousel-control-next {
    right: 10px;
}

#main_slider a.carousel-control-prev {
    left: 10px;
}

#main_slider .carousel-control-next:focus,
#main_slider .carousel-control-next:hover,
#main_slider .carousel-control-prev:focus,
#main_slider .carousel-control-prev:hover {
    color: #ffffff;
    background-color: #EC7A1C;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f8f9fa;
}
.images img {
  display: flex;
  width: 150px;
  height: 100px; 
  object-fit: cover;
}

.card {
  width: 190px;
  height: 254px;
  background: #ffffff;
  border-radius: 20px;
  position: relative;
  overflow: hidden;
  transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.2);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, sans-serif;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
}

.card-container ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}

.card-container li {
    flex: 0 0 20%;
    margin: 0;
    box-sizing: border-box;
}

.card__shine {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    120deg,
    rgba(255, 255, 255, 0) 40%,
    rgba(255, 255, 255, 0.8) 50%,
    rgba(255, 255, 255, 0) 60%
  );
  opacity: 0;
  transition: opacity 0.3s ease;
}

.card__glow {
  position: absolute;
  inset: -10px;
  background: radial-gradient(
    circle at 50% 0%,
    rgba(236, 122, 28, 0.3) 0%,
    rgba(124, 58, 237, 0) 70%
  );
  opacity: 0;
  transition: opacity 0.5s ease;
}

.card__content {
  padding: 1.25em;
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 0.75em;
  position: relative;
  z-index: 2;
}

.card__badge {
  position: absolute;
  top: 12px;
  right: 12px;
  color: white;
  padding: 0.25em 0.5em;
  border-radius: 999px;
  font-size: 0.7em;
  font-weight: 600;
  transform: scale(0.8);
  opacity: 0;
  transition: all 0.4s ease 0.1s;
}

.best {
    background: #ffd700;
}

.new {
      background: #780606;
}

.ess {
      background: #00ff7f;
}

.oth {
      background: #4166f5;
}

.card__image {
  width: 100%;
  height: 100px;
  border-radius: 12px;
  transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
}

.card__image::after {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(
      circle at 30% 30%,
      rgba(255, 255, 255, 0.1) 0%,
      transparent 30%
    ),
    repeating-linear-gradient(
      45deg,
      rgba(139, 92, 246, 0.1) 0px,
      rgba(139, 92, 246, 0.1) 2px,
      transparent 2px,
      transparent 4px
    );
  opacity: 0.5;
}

.card__text {
  display: flex;
  flex-direction: column;
  gap: 0.25em;
}

.card__title {
    font-size: 1.1em;
    margin: 0;
    font-weight: 700;
    transition: all 0.3s ease;
    white-space: normal;
    text-overflow: ellipsis; 
    max-height: 3em;
    line-height: 1.2em;
}

.card__description {
  font-size: 0.75em;
  margin: 0;
  opacity: 0.7;
  transition: all 0.3s ease;
}

.card__footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
}

.card__price {
  font-weight: 700;
  font-size: 1em;
  transition: all 0.3s ease;
}

.card__button {
  width: 28px;
  height: 28px;
  background: #EC7A1C;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  cursor: pointer;
  transition: all 0.3s ease;
  transform: scale(0.9);
}

.card:hover {
  transform: translateY(-10px);
  box-shadow:
    0 20px 25px -5px rgba(0, 0, 0, 0.1),
    0 10px 10px -5px rgba(0, 0, 0, 0.04);
  border-color: rgba(236, 122, 28, 0.3);
}

.card:hover .card__shine {
  opacity: 1;
  animation: shine 3s infinite;
}

.card:hover .card__glow {
  opacity: 1;
}

.card:hover .card__badge {
  transform: scale(1);
  opacity: 1;
  z-index: 1;
}

.card:hover .card__image {
  transform: translateY(-5px) scale(1.03);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.card:hover .card__title {
  color: rgb(236, 122, 28);
  transform: translateX(2px);
}

.card:hover .card__description {
  opacity: 1;
  transform: translateX(2px);
}

.card:hover .card__price {
  color: rgb(236, 122, 28);
  transform: translateX(2px);
}

.card:hover .card__button {
  transform: scale(1);
  box-shadow: 0 0 0 4px rgba(236, 122, 28, 0.3);
}

.card:hover .card__button svg {
  animation: pulse 1.5s infinite;
}

.card:active {
  transform: translateY(-5px) scale(0.98);
}

@keyframes shine {
  0% {
    background-position: -100% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.2);
  }
  100% {
    transform: scale(1);
  }
}

@media (max-width: 768px) {
    .card-container li {
        flex: 0 0 50%;
    }
}
</style>
<section class="py-4">
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="catbtn shadow-none d-flex align-items-center justify-content-between text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down  float-right mt-1"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 340px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Brands<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-light border-0 rounded-0 w-100 m-0">
                                <a href="?page=results&q=shimano" class="dropdown-item">Shimano</a>
                                <a href="?page=results&q=favero" class="dropdown-item">Favero</a>
                                <a href="?page=results&q=magene" class="dropdown-item">Magene</a>
                                <a href="?page=results&q=dare" class="dropdown-item">DARE</a>
                                <a href="?page=results&q=continental" class="dropdown-item">Continental</a>
                                <a href="?page=results&q=shokz" class="dropdown-item">Shokz</a>
                            </div>
                        </div>
                        <a href="?page=results&q=frame" class="nav-item nav-link">Frames</a>
                        <a href="?page=results&q=tire" class="nav-item nav-link">Tires</a>
                        <a href="?page=results&q=saddle" class="nav-item nav-link">Saddles</a>
                        <a href="?page=results&q=handlebar" class="nav-item nav-link">Handlebars</a>
                        <a href="?page=results&q=pedal" class="nav-item nav-link">Pedals</a>
                        <a href="?page=results&q=accessories" class="nav-item nav-link">Accessories</a>
                        <a href="?page=results&q=others" class="nav-item nav-link">Others</a>
                    </div>
                </nav>
            </div>

            <!--HOME CAR-->
            <div class="col-lg-9">
                <div id="main_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/custom1.png" alt="Banner Image 1">
                            <div class="banner_title">
                                <h1 class="bike_text">Online BikeShop</h1>
                                <p class="subtext">Discover a wide range of bicycles and accessories tailored for every rider.<br>
                                    Shop from the comfort of your home and enjoy exclusive online deals.</p>
                                <div class="buttonbutton">
                                    <button type="button" onclick="location.href='./?page=about';">Learn More</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/giant1.png" alt="Banner Image 2">
                            <div class="banner_title">
                                <h1 class="bike_text">Best Sellers</h1>
                                <p class="subtext">Explore our top-selling bikes won the hearts of riders everywhere.<br>
                                    Quality, performance, and style come together in our best-selling collection.</p>
                                <div class="buttonbutton">
                                    <button type="button" onclick="toggleSection('bestsellers');">Shop Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/custom1.png" alt="Banner Image 3">
                            <div class="banner_title">
                                <h1 class="bike_text">New Arrivals</h1>
                                <p class="subtext">Check out the latest additions to our bike collection.<br>
                                    Stay ahead of the trends with our new arrivals, designed for both performance and style.</p>
                                <div class="buttonbutton">
                                    <button type="button" onclick="toggleSection('new-arrivals');">Shop Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/giant1.png" alt="Banner Image 4">
                            <div class="banner_title">
                                <h1 class="bike_text">Biking Essentials</h1>
                                <p class="subtext">Gear up with our essential biking accessories.<br>
                                    From helmets to maintenance tools, we have everything you need for a safe and enjoyable ride.</p>
                                <div class="buttonbutton">
                                    <button type="button" onclick="toggleSection('spring-essentials');">Shop Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/custom1.png" alt="Banner Image 5">
                            <div class="banner_title">
                                <h1 class="bike_text">OLIs CRIB</h1>
                                <p class="subtext">Join our community of biking enthusiasts at OLIs CRIB.<br>
                                    Connect with fellow riders, share experiences, and get tips on the best biking routes.</p>
                                <div class="buttonbutton">
                                    <button type="button" onclick="location.href='./?page=contact';">Get in Touch</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/giant1.png" alt="Banner Image 6">
                            <div class="banner_title">
                                <h1 class="bike_text">Order and Checkout Now</h1>
                                <p class="subtext">Ready to ride? Complete your order and checkout seamlessly.<br>
                                    Enjoy fast shipping and excellent customer service with every purchase.</p>
                                <div class="buttonbutton">
                                    <button type="button" onclick="location.href='./?page=checkout';">Your Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="cardcontainer">
        <div class="section" id="bestsellers">
            <h2>Best Sellers</h2>
            <p>Explore our top-selling bikes that have won hearts of riders.<br>
                Quality, performance, and style come together in our best-selling collection.</p>
            <div class="buttons">
                <button class="explorebtn" onclick="toggleSection('bestsellers');">Explore</button>
            </div>
        </div>

        <div class="section" id="new-arrivals">
            <h2>New Arrivals</h2>
            <p>Check out the latest additions to our bike collection.<br>
                Stay ahead of the trends with our new arrivals, designed for both performance and style.</p>
            <div class="buttons">
                <button class="explorebtn" onclick="toggleSection('new-arrivals');">Explore</button>
            </div>
        </div>

        <div class="section" id="spring-essentials">
            <h2>Biking Essentials</h2>
            <p>Gear up with our essential biking accessories.<br>
                From helmets to maintenance tools, we have everything you need for a safe and enjoyable ride.</p>
            <div class="buttons">
                <button class="explorebtn" onclick="toggleSection('spring-essentials');">Explore</button>
            </div>
        </div>
    </div>

<script>
let currentVisibleSection = null; // Track the currently visible section

function toggleSection(sectionId) {
    // Get all sections
    const sections = {
        bestsellers: document.getElementById('bestsellers'),
        'new-arrivals': document.getElementById('new-arrivals'),
        'spring-essentials': document.getElementById('spring-essentials')
    };

    // Check if the clicked section is currently visible
    const selectedSection = sections[sectionId];

    if (currentVisibleSection === sectionId) {
        // If the same section is clicked again, show all sections
        for (const key in sections) {
            if (sections.hasOwnProperty(key)) {
                sections[key].style.display = 'block';
            }
        }
        currentVisibleSection = null; // Reset to indicate all are visible
        //show all product cards
        showProductCards('all');

    } else {
        // Otherwise, hide all and show only the selected section
        for (const key in sections) {
            if (sections.hasOwnProperty(key)) {
                sections[key].style.display = 'block'; // Keep sections visible
            }
        }
        currentVisibleSection = sectionId; // Update to track the single visible section
        //show relevant product cards
        showProductCards(sectionId);
    }
}


function showProductCards(category) {
    const cardContainers = {
        'bestsellers': {
            wrapper: document.querySelector('.card-container:nth-of-type(1) .card-wrapper'),
            heading: document.querySelector('.card-container:nth-of-type(1) h2')
        },
        'new-arrivals': {
            wrapper: document.querySelector('.card-container:nth-of-type(2) .card-wrapper'),
            heading: document.querySelector('.card-container:nth-of-type(2) h2')
        },
        'spring-essentials': {
            wrapper: document.querySelector('.card-container:nth-of-type(3) .card-wrapper'),
            heading: document.querySelector('.card-container:nth-of-type(3) h2')
        },
        'other-products': { // Add this
            wrapper: document.querySelector('.card-container:nth-of-type(4) .card-wrapper'), //select the 4th card container
            heading: document.querySelector('.card-container:nth-of-type(4) h2') //and its heading
        },
        'all': Array.from(document.querySelectorAll('.card-container')).reduce((acc, container) => {
            const wrapper = container.querySelector('.card-wrapper');
            const heading = container.querySelector('h2');
            if (wrapper && heading) {
                acc.push({ wrapper, heading });
            }
            return acc;
        }, [])
    };

    if (category === 'all') {
        if (Array.isArray(cardContainers['all'])) {
            cardContainers['all'].forEach(item => {
                item.wrapper.style.display = 'flex';
                item.heading.style.display = 'block';
            });
        }
    } else if (cardContainers[category]) {
        // Hide all card containers first
        for (const key in cardContainers) {
            if (cardContainers.hasOwnProperty(key) && key !== 'all') {
                cardContainers[key].wrapper.style.display = 'none';
                cardContainers[key].heading.style.display = 'none';
            }
        }
        cardContainers[category].wrapper.style.display = 'flex';
        cardContainers[category].heading.style.display = 'block';
    } else {
        if (Array.isArray(cardContainers['all'])) {
            cardContainers['all'].forEach(item => {
                item.wrapper.style.display = 'flex';
                item.heading.style.display = 'block';
            });
        }
    }
}

showProductCards('all');

if (window.location.hash) {
    const targetId = window.location.hash.substring(1);
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
        targetElement.scrollIntoView({
            behavior: 'smooth'
        });
    }
}
</script>


<?php
include 'dbconi.php';

$query = isset($_GET['q']) ? $_GET['q'] : '';
$query = mysqli_real_escape_string($dbc, $query);
$sql = "SELECT * FROM bikes WHERE model LIKE '%$query%' OR brand LIKE '%$query%' OR part LIKE '%$query%'";
$result = mysqli_query($dbc, $sql);
?>

<section class="py-3 px-5">
    <div class="card-container" style="overflow-x: auto; white-space: nowrap; margin-bottom: 20px;">
        <h2>Best Sellers</h2><br>
        <div class="card-wrapper">  <ul style="display: inline-block; padding: 0;">
                <?php
                $bestSellersQuery = "SELECT * FROM bikes WHERE type = 'best'";
                $bestSellersResult = mysqli_query($dbc, $bestSellersQuery);
                if (mysqli_num_rows($bestSellersResult) > 0):
                    while ($row = mysqli_fetch_assoc($bestSellersResult)): ?>
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="./?page=views&id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card__shine"></div>
                                    <div class="card__glow"></div>
                                    <div class="card__content">
                                        <div class="card__badge best">BEST SELLER</div>
                                        <div style="--bg-color: #44443B" class="card__image">
                                            <div class="images">
                                                <img src="images/bayk1.png" alt="Product Image" />
                                            </div>
                                        </div>
                                        <div class="card__text">
                                            <p class="card__title"><?php echo htmlspecialchars($row['model']); ?></p>
                                            <p class="card__description"><?php echo htmlspecialchars($row['brand']); ?></p>
                                        </div>
                                        <div class="card__footer">
                                            <div class="card__price">₱<?php echo htmlspecialchars($row['price']); ?></div>
                                            <div class="card__button">
                                                <svg height="16" width="16" viewBox="0 0 24 24">
                                                    <path stroke-width="2" stroke="currentColor" d="M4 12H20M12 4V20" fill="currentColor"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No best sellers found.</li>
                <?php endif; ?>
            </ul>
        </div> </div>

    <div class="card-container" style="overflow-x: auto; white-space: nowrap; margin-bottom: 20px;">
        <h2>New Arrivals</h2><br>
        <div class="card-wrapper">  <ul style="display: inline-block; padding: 0;">
                <?php
                $newArrivalsQuery = "SELECT * FROM bikes WHERE type = 'new'";
                $newArrivalsResult = mysqli_query($dbc, $newArrivalsQuery);
                if (mysqli_num_rows($newArrivalsResult) > 0):
                    while ($row = mysqli_fetch_assoc($newArrivalsResult)): ?>
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="./?page=views&id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card__shine"></div>
                                    <div class="card__glow"></div>
                                    <div class="card__content">
                                        <div class="card__badge new">NEW ARRIVAL</div>
                                        <div style="--bg-color: #44443B" class="card__image">
                                            <div class="images">
                                                <img src="images/bayk1.png" alt="Product Image" />
                                            </div>
                                        </div>
                                        <div class="card__text">
                                            <p class="card__title"><?php echo htmlspecialchars($row['model']); ?></p>
                                            <p class="card__description"><?php echo htmlspecialchars($row['brand']); ?></p>
                                        </div>
                                        <div class="card__footer">
                                            <div class="card__price">₱<?php echo htmlspecialchars($row['price']); ?></div>
                                            <div class="card__button">
                                                <svg height="16" width="16" viewBox="0 0 24 24">
                                                    <path stroke-width="2" stroke="currentColor" d="M4 12H20M12 4V20" fill="currentColor"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No new arrivals found.</li>
                <?php endif; ?>
            </ul>
        </div>  </div>

    <div class="card-container" style="overflow-x: auto; white-space: nowrap; margin-bottom: 20px;">
        <h2>Featured Essentials</h2><br>
        <div class="card-wrapper">  <ul style="display: inline-block; padding: 0;">
                <?php
                $essentialsQuery = "SELECT * FROM bikes WHERE type = 'ess'";
                $essentialsResult = mysqli_query($dbc, $essentialsQuery);
                if (mysqli_num_rows($essentialsResult) > 0):
                    while ($row = mysqli_fetch_assoc($essentialsResult)): ?>
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="./?page=views&id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card__shine"></div>
                                    <div class="card__glow"></div>
                                    <div class="card__content">
                                        <div class="card__badge ess"> FEATURED</div>
                                        <div style="--bg-color: #44443B" class="card__image">
                                            <div class="images">
                                                <img src="images/bayk1.png" alt="Product Image" />
                                            </div>
                                        </div>
                                        <div class="card__text">
                                            <p class="card__title"><?php echo htmlspecialchars($row['model']); ?></p>
                                            <p class="card__description"><?php echo htmlspecialchars($row['brand']); ?></p>
                                        </div>
                                        <div class="card__footer">
                                            <div class="card__price">₱<?php echo htmlspecialchars($row['price']); ?></div>
                                            <div class="card__button">
                                                <svg height="16" width="16" viewBox="0 0 24 24">
                                                    <path stroke-width="2" stroke="currentColor" d="M4 12H20M12 4V20" fill="currentColor"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No featured essentials found.</li>
                <?php endif; ?>
            </ul>
        </div>  </div>

    <div class="card-container" style="overflow-x: auto; white-space: nowrap; margin-bottom: 20px;">
        <h2>Other Products</h2><br>
        <div class="card-wrapper">  <ul style="display: inline-block; padding: 0;">
                <?php
                $essentialsQuery = "SELECT * FROM bikes WHERE type = 'acc'";
                $essentialsResult = mysqli_query($dbc, $essentialsQuery);
                if (mysqli_num_rows($essentialsResult) > 0):
                    while ($row = mysqli_fetch_assoc($essentialsResult)): ?>
                        <li style="display: inline-block; margin-right: 10px;">
                            <a href="./?page=views&id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
                                <div class="card">
                                    <div class="card__shine"></div>
                                    <div class="card__glow"></div>
                                    <div class="card__content">
                                         <div class="card__badge oth">ACCESSORIES</div>
                                        <div style="--bg-color: #44443B" class="card__image">
                                            <div class="images">
                                                <img src="images/bayk1.png" alt="Product Image" />
                                            </div>
                                        </div>
                                        <div class="card__text">
                                            <p class="card__title"><?php echo htmlspecialchars($row['model']); ?></p>
                                            <p class="card__description"><?php echo htmlspecialchars($row['brand']); ?></p>
                                        </div>
                                        <div class="card__footer">
                                            <div class="card__price">₱<?php echo htmlspecialchars($row['price']); ?></div>
                                            <div class="card__button">
                                                <svg height="16" width="16" viewBox="0 0 24 24">
                                                    <path stroke-width="2" stroke="currentColor" d="M4 12H20M12 4V20" fill="currentColor"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No accessories found.</li>
                <?php endif; ?>
            </ul>
        </div>  </div>
</section>
