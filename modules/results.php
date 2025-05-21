<?php
include 'dbconi.php';

$query = isset($_GET['q']) ? $_GET['q'] : '';
$query = mysqli_real_escape_string($dbc, $query);
$sql = "SELECT * FROM bikes WHERE model LIKE '%$query%' OR brand LIKE '%$query%' OR part LIKE '%$query%'";
$result = mysqli_query($dbc, $sql);
?>

<section class="py-3 px-5">
    <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
    <div class="card-container">
        <ul>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <li>
                        <a href="./?page=views&id=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
                            <div class="card">
                                <div class="card__shine"></div>
                                <div class="card__glow"></div>
                                <div class="card__content">
                                    <div class="card__badge">NEW</div>
                                    <div style="--bg-color: #44443B" class="card__image">
                                        <div class="images">
                                            <img src="images/bayk1.png" alt="Product Image" />
                                        </div>
                                    </div>
                                    <div class="card__text">
                                        <p class="card__title">
                                            <?php echo htmlspecialchars($row['model']); ?>
                                        </p>
                                        <p class="card__description"><?php echo htmlspecialchars($row['brand']); ?></p>
                                    </div>
                                    <div class="card__footer">
                                        <div class="card__price">₱<?php echo htmlspecialchars($row['price']); ?></div>
                                        <div class="card__button">
                                            <svg height="16" width="16" viewBox="0 0 24 24">
                                                <path
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    d="M4 12H20M12 4V20"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li>No results found for "<?php echo htmlspecialchars($query); ?>".</li>
            <?php endif; ?>
        </ul>
    </div>
</section>
<style>
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
  background: #D10024;
  color: white;
  padding: 0.25em 0.5em;
  border-radius: 999px;
  font-size: 0.7em;
  font-weight: 600;
  transform: scale(0.8);
  opacity: 0;
  transition: all 0.4s ease 0.1s;
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