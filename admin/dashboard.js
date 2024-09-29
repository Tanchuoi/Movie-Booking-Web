var dashboard = document.getElementById("dashboard");
var categories = document.getElementById("categories");
var movies = document.getElementById("movies");
var users = document.getElementById("users");

var dashboardContent = document.getElementById("dashboardContent");
var categoriesContent = document.getElementById("categoriesContent");
var moviesContent = document.getElementById("moviesContent");
var usersContent = document.getElementById("usersContent");

function resetWhenClick() {
  dashboardContent.style.display = "none";
  categoriesContent.style.display = "none";
  moviesContent.style.display = "none";
  usersContent.style.display = "none";

  dashboard.style.fontWeight = "normal";
  categories.style.fontWeight = "normal";
  movies.style.fontWeight = "normal";
  users.style.fontWeight = "normal";
}

dashboard.addEventListener("click", function () {
  resetWhenClick();
  dashboardContent.style.display = "block";
  dashboard.style.fontWeight = "bold";
});

categories.addEventListener("click", function () {
  resetWhenClick();
  categoriesContent.style.display = "block";
  categories.style.fontWeight = "bold";
});

movies.addEventListener("click", function () {
  resetWhenClick();
  moviesContent.style.display = "block";
  movies.style.fontWeight = "bold";
});

users.addEventListener("click", function () {
  resetWhenClick();
  usersContent.style.display = "block";
  users.style.fontWeight = "bold";
});
