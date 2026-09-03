var registerLink = document.getElementById("registerLink");
var registrationFormOverlay = document.getElementById("registrationFormOverlay");

if (registerLink && registrationFormOverlay) {
  registerLink.addEventListener("click", function(e) {
    e.preventDefault();
    registrationFormOverlay.style.display = "block";
  });

  document.addEventListener("click", function(e) {
    if (e.target === registrationFormOverlay) {
      registrationFormOverlay.style.display = "none";
    }
  });
}



var loginLink = document.getElementById("loginLink");
var loginFormOverlay = document.getElementById("loginFormOverlay");

if (loginLink && loginFormOverlay) {
  loginLink.addEventListener("click", function(event) {
    event.preventDefault();
    loginFormOverlay.style.display = "block";
  });

  loginFormOverlay.addEventListener("click", function(event) {
    if (event.target === this) {
      this.style.display = "none";
    }
  });
}



var editProfileLink = document.getElementById("editProfileLink");
var editProfileOverlay = document.getElementById("editProfileOverlay");
var editProfileClose = document.getElementById("editProfileClose");

if (editProfileLink && editProfileOverlay) {
  editProfileLink.addEventListener("click", function(e) {
    e.preventDefault();
    editProfileOverlay.style.display = "flex";
  });

  editProfileOverlay.addEventListener("click", function(e) {
    if (e.target === editProfileOverlay) {
      editProfileOverlay.style.display = "none";
    }
  });

  if (editProfileClose) {
    editProfileClose.addEventListener("click", function() {
      editProfileOverlay.style.display = "none";
    });
  }
}



// --- Заглушки для поиска, избранного и корзины ---

function showStub(message) {
  var toast = document.getElementById("stubToast");
  if (!toast) {
    toast = document.createElement("div");
    toast.id = "stubToast";
    document.body.appendChild(toast);
  }
  toast.textContent = message;
  toast.classList.add("show");
  clearTimeout(window._stubToastTimer);
  window._stubToastTimer = setTimeout(function() {
    toast.classList.remove("show");
  }, 2200);
}

var searchBtn = document.getElementById("searchBtn");
var searchInput = document.getElementById("searchInput");
var favBtn = document.getElementById("favBtn");
var cartBtn = document.getElementById("cartBtn");

if (searchBtn) {
  searchBtn.addEventListener("click", function(e) {
    e.preventDefault();
    showStub("Поиск пока в разработке");
  });
}

if (searchInput) {
  searchInput.addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
      e.preventDefault();
      showStub("Поиск пока в разработке");
    }
  });
}

if (favBtn) {
  favBtn.addEventListener("click", function(e) {
    e.preventDefault();
    showStub("Избранное пока в разработке");
  });
}

if (cartBtn) {
  cartBtn.addEventListener("click", function(e) {
    e.preventDefault();
    showStub("Корзина пока в разработке");
  });
}
