<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';
$isAdmin = isset($_SESSION['userrole']) && $_SESSION['userrole'] === 'admin'
?>
<div id="header">
    <div class="container">
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-3">
                <div class="header-logo">
                    <a href="./?page=home" class="logo">
                        <img src="images/OLI.png" alt="logo" style="height: 75px;">
                    </a>
                </div>
            </div>
            <!-- SEARCH -->
            <div class="col-md-6">
                <div class="header-search">
                    <form id="searchForm" onsubmit="return false;">
                        <input class="input" id="searchInput" placeholder="Search here" onkeyup="searchItems()">
                        <button type="button" class="search-btn" onclick="performSearch()">Search</button>
                    </form>
                    <div id="searchResults" class="search-results" style="display: none;"></div>
                </div>
            </div>            
            <!-- ACCOUNT -->
            <div class="col-md-3">
                <div class="account">
                    <div>
                        <?php if (isset($_SESSION['userfullname'])): ?>
                            <a href="./?page=user">
                                <i class="fa fa-user-circle"></i>
                                <span><?php echo htmlspecialchars($_SESSION['userfullname']); ?></span>
                            </a>
                        <?php else: ?>
                            <a href="modules/login.php">
                                <i class="fa fa-user-circle"></i>
                                <span style="color: red;">Login Here</span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if (isset($_SESSION['loginok'])): ?>
                            <a href="./?page=checkout">
                                <i class="fa fa-shopping-cart"></i>
                                <span style="<?php echo $current_page === 'checkout' ? 'color: red' : ''; ?>">Cart</span>
                            </a>
                        <?php else: ?>
                            <a href="modules/login.php">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Cart</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- NAVIGATION -->
<div id="navigation">
    <nav id="navigation">
        <div class="container">
            <div class="navbar">
                <ul class="main-nav nav">
                    <li class="<?php echo $current_page === 'home' ? 'active' : ''; ?>"><a href="./?page=home">Home</a></li>
                    <li class="<?php echo $current_page === 'products' ? 'active' : ''; ?>"><a href="./?page=products">Products</a></li>
                    <li class="<?php echo $current_page === 'about' ? 'active' : ''; ?>"><a href="./?page=about">About Us</a></li>
                    <li class="<?php echo $current_page === 'contact' ? 'active' : ''; ?>"><a href="./?page=contact">Contact Us</a></li>
                    <?php if ($isAdmin): ?>
                        <li class="<?php echo $current_page === 'admin' ? 'active' : ''; ?>"><a href="./?page=admin">!Dashboard</a></li>
                        <li class="<?php echo $current_page === 'items' ? 'active' : ''; ?>"><a href="./?page=items">!Items</a></li>
                        <li class="<?php echo $current_page === 'accounts' ? 'active' : ''; ?>"><a href="./?page=accounts">!Accounts</a></li>
                        <li class="<?php echo $current_page === 'payment' ? 'active' : ''; ?>"><a href="./?page=payment">!Payment</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div id="divider"></div>
    </nav>
</div>
<script>
    function openModal() {
        $('#userModal').modal('show');
    }
</script>