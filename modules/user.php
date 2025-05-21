<?php
include("dbconi.php");
$row = null;
if (isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
    $query = "SELECT * FROM users WHERE id= '" . mysqli_real_escape_string($dbc, $id) . "'";
    $result = mysqli_query($dbc, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "User  not found or query error.";
    }
} else {
    echo "User  not logged in.";
}
?>

<style>
  * {
    box-sizing: border-box;
  }
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f2f5;
    color: #333;
  }
  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  header.profile-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 25px 20px;
    text-align: center;
    flex-shrink: 0;
  }
  header.profile-header h1 {
    margin: 5px 0 3px;
    font-size: 2rem;
    font-weight: 700;
    line-height: 1.2;
  }
  header.profile-header p.email {
    font-size: 1rem;
    opacity: 0.85;
    margin: 0;
    user-select: text;
  }

  main.profile-main {
    flex-grow: 1;
    padding: 20px 25px;
    overflow-y: auto;
  }

  section {
    max-width: 900px;
    margin: 0 auto 30px auto;
    background: white;
    border-radius: 12px;
    padding: 25px 30px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
  }

  .section-title {
    font-weight: 700;
    font-size: 1.4rem;
    margin-bottom: 18px;
    border-bottom: 3px solid #667eea;
    display: inline-block;
    padding-bottom: 6px;
    color: #444;
  }

  form#profileForm {
    display: flex;
    flex-wrap: wrap;
    gap: 20px 30px;
  }

  form#profileForm > div {
    flex: 1 1 300px;
    display: flex;
    flex-direction: column;
  }

  label {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 6px;
    color: #444;
  }

  input[type="text"], input[type="email"] {
    padding: 14px 16px;
    font-size: 1.1rem;
    border: 1.5px solid #ccc;
    border-radius: 10px;
    transition: border-color 0.3s ease;
    width: 100%;
  }

  input[type="text"]:focus,
  input[type="email"]:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 8px rgba(102, 126, 234, 0.6);
  }

  input[readonly] {
    background-color: #f5f7fa;
    color: #666;
    cursor: default;
  }

  textarea {
    width: 100%;
    min-height: 100px;
    resize: vertical;
    font-family: inherit;
    padding: 14px 16px;
    font-size: 1.1rem;
    border: 1.5px solid #ccc;
    border-radius: 10px;
    transition: border-color 0.3s ease;
    line-height: 1.4;
  }

  textarea:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 8px rgba(102, 126, 234, 0.6);
  }

  textarea[readonly] {
    background-color: #f5f7fa;
    color: #666;
    cursor: default;
  }

  .orders-list {
    max-height: none;
    padding-right: 10px;
  }

  .order-item {
    border: 1px solid #ddd;
    border-radius: 14px;
    background-color: #fafafa;
    padding: 20px 25px;
    margin-bottom: 18px;
    font-size: 1rem;
    display: flex;
    flex-direction: column;
    gap: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.07);
    transition: box-shadow 0.3s ease;
    cursor: default;
  }

  .order-item:last-child {
    margin-bottom: 0;
  }

  .order-item:hover, .order-item:focus {
    box-shadow: 0 8px 20px rgba(102,126,234,0.3);
    outline: none;
  }

  .order-id {
    font-weight: 700;
    color: #667eea;
    font-size: 1.1rem;
  }

  .order-status {
    font-weight: 700;
    padding: 6px 14px;
    display: inline-block;
    border-radius: 25px;
    font-size: 0.95rem;
    color: white;
    width: fit-content;
    user-select: none;
  }

  .status-pending {
    background-color: #f39c12;
  }
  .status-shipped {
    background-color: #27ae60;
  }
  .status-cancelled {
    background-color: #e74c3c;
  }

  .btn-edit-save {
    background-color: #667eea;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 16px 0;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    width: 180px;
    transition: background-color 0.3s ease;
    margin: 0 10px;
  }

  .btn-edit-save:hover,
  .btn-edit-save:focus {
    background-color: #5563c1;
  }

  #file-upload {
    display: none; /* Hide the actual file input */
  }

  .file-upload-wrapper {
    background-color: #667eea;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 16px 0;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    width: 180px;
    transition: background-color 0.3s ease;
    margin: 0 10px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .file-upload-wrapper:hover,
  .file-upload-wrapper:focus {
    background-color: #5563c1;
  }

  .file-upload-text {
    font-size: 15px;
    color: #fff;
    margin-right: 8px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  @media (max-width: 500px) {
    header.profile-header {
      font-size: 14px;
      padding: 20px 15px;
    }
    header.profile-header h1 {
      font-size: 1.7rem;
    }
    main.profile-main {
      padding: 15px 20px 20px;
    }
    section {
      margin-bottom: 20px;
      padding: 20px 20px;
    }
    form#profileForm {
      flex-direction: column;
    }
    form#profileForm > div {
      flex-basis: 100%;
    }
    .btn-edit-save {
      width: 100%;
      padding: 14px;
      font-size: 1rem;
    }
    .file-upload-wrapper {
      width: 100%;
      margin-top: 15px;
      font-size: 1rem;
    }
    .orders-list {
      max-height: 240px;
    }
  }
</style>

<div class="py-3"></div>
<section class="profile-details" aria-labelledby="profileInfoTitle">
  <h2 id="profileInfoTitle" class="section-title">Profile Information</h2>
  <form id="profileForm" aria-label="Profile information form">
    <input type="hidden" name="txtid" value="<?php echo $row['id']; ?>" />
    <input type="hidden" name="txtpass" value="<?php echo $row['password']; ?>" />
    <div>
      <label for="fnameInput">Full Name</label>
      <input type="text" id="txtfull" name="txtfull" value="<?php echo isset($row) ? htmlspecialchars($row['fullname']) : 'Guest'; ?>" readonly autocomplete="fname" />
    </div>
    <div>
      <label for="unameInput">User  Name</label>
      <input type="text" id="txtuser" name="txtuser" value="<?php echo isset($row) ? htmlspecialchars($row['username']) : 'Guest'; ?>" readonly autocomplete="uname" />
    </div>
    
    <div>
      <label for="addressInput">Address</label>
      <textarea id="txtaddress" name="txtaddress" readonly autocomplete="address"><?php echo isset($row) ? htmlspecialchars($row['address']) : 'Guest'; ?></textarea>
    </div>
    <div>
        <label for="imageUpload">Profile Image</label>
        <div class="file-upload-wrapper" id="customFileTrigger">
            <span class="file-upload-text">Choose File</span>
            <input type="file" id="file-upload" name="profile" accept="image/*" disabled />
        </div>
    </div>
    <div style="display: flex; gap: 10px; margin-top: 15px;">
        <button type="button" id="editBtn" class="btn-edit-save" aria-pressed="false" aria-label="Edit profile information">Edit Profile</button>
        <button type="button" id="logBtn" class="btn-edit-save" aria-pressed="false" aria-label="logout">Log Out</button>
    </div>
  </form>
</section>
<section class="orders" aria-labelledby="pendingOrdersTitle">
  <h2 id="pendingOrdersTitle" class="section-title">Pending Orders</h2>
  <div class="orders-list" aria-live="polite" aria-label="List of pending orders" tabindex="0">
    <div id="contS"></div>
  </div>
</section>
<script>
$(document).ready(function() {
  const editBtn = document.getElementById('editBtn');
  const nameInput = document.getElementById('txtfull');
  const usernameInput = document.getElementById('txtuser');
  const addressInput = document.getElementById('txtaddress');
  const fileUpload = document.getElementById('file-upload');
  let isEditing = false;

  editBtn.addEventListener('click', () => {
    if (!isEditing) {
      nameInput.readOnly = false;
      usernameInput.readOnly = false;
      addressInput.readOnly = false;
      fileUpload.disabled = false; // Enable file upload
      editBtn.textContent = 'Save Changes';
      editBtn.setAttribute('aria-pressed', 'true');
      isEditing = true;
    } else {
      // Save the edited data
      const form = document.getElementById('profileForm');
      var formData = new FormData(form);
      $.ajax({
        url: "modules/accounts_editreq.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if (response === 'success') {
            alert("Profile Successfully Updated");
            nameInput.readOnly = true;
            usernameInput.readOnly = true;
            addressInput.readOnly = true;
            fileUpload.disabled = true; // Disable file upload again
            editBtn.textContent = 'Edit Profile';
            editBtn.setAttribute('aria-pressed', 'false');
            isEditing = false;
            window.location.href = '?page=user'; // Redirect
          } else {
            alert(response);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("AJAX Error:", textStatus, errorThrown);
          alert('Failed to save profile changes. Please check the console for details.');
        }
      });
    }
  });

  $('#customFileTrigger').on('click', function() {
    if (!fileUpload.disabled) {
      fileUpload.click();
    }
  });

  $('#file-upload').change(function() {
    var filename = $(this).val().split('\\').pop();
    $('.file-upload-text').text(filename ? filename : 'Choose File');
  });

  // Logout button functionality
  const logBtn = document.getElementById('logBtn');
  logBtn.addEventListener('click', () => {
    if (confirm("Are you sure you want to log out?")) {
      window.location.href = 'modules/logout_req.php?logout=true';
    } else {
      alert("Logout canceled.");
    }
  });

  LoadPayment(1);

  function LoadPayment(pageNum) {
    $.post("modules/pending_list.php", {
      pagenum: pageNum,
      txtsearch: $("input[name='txtsearch']").val()
    }, function(paymentData) {
      $("#contS").html(paymentData);
      history.pushState(null, '', '?page=pending&pagenum=' + pageNum + '&txtsearch=' + encodeURIComponent($("input[name='txtsearch']").val()));
    }).fail(function() {
      console.error("Error loading transaction data.");
    });
  }

  $(document).on('click', '.pagination .page-link', function(e) {
    e.preventDefault();
    var pageNum = $(this).data('pagenum');
    LoadPayment(pageNum);
  });

  $("input[name='txtsearch']").on('input', function() {
    LoadPayment(1);
  });

  $("#btnsearchpay").click(function(event) {
    event.preventDefault();
    LoadPayment();
  });
});
</script>
