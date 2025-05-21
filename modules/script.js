function searchItems() {
	var input = document.getElementById('searchInput').value;
	if (input.length > 0) {
		fetch('search.php?q=' + input)
			.then(response => response.json())
			.then(data => {
				var resultsDiv = document.getElementById('searchResults');
				resultsDiv.innerHTML = '';
				if (data.length > 0) {
					data.forEach(item => {
						var itemDiv = document.createElement('div');
						itemDiv.innerHTML = `<a href="${item.link}">${item.name}</a>`;
						resultsDiv.appendChild(itemDiv);
					});
					resultsDiv.style.display = 'block';
				} else {
					resultsDiv.style.display = 'none';
				}
			});
	} else {
		document.getElementById('searchResults').style.display = 'none';
	}
}

function performSearch() {
    var input = document.getElementById('searchInput').value;
    if (input.length > 0) {
        window.location.href = './?page=results&q=' + encodeURIComponent(input);
    }
}

function deleteItem(productId) {
    if (confirm("Are you sure you want to remove this item from your cart?")) {
        $.ajax({
            url: 'modules/cart_delete.php',
            type: 'POST',
            data: { id: productId },
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert("An error occurred while trying to delete the item.");
            }
        });
    }
}

function logoutAlert() {
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = 'modules/logout_req.php?logout=true';
    } else {
        alert("Logout canceled.");
    }
}

function checkoutAlert() {
	const totalPrice = document.getElementById('totalPrice').innerText;
	const confirmation = confirm("Are you sure you want to pay now? Total amount: " + totalPrice);
	if (confirmation) {
		alert("Proceeding to payment...");
	} else {
		alert("Payment canceled.");
	}
}