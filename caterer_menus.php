<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.png" type="image/x-icon">
    <title>DineTrack - Add Menu</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap JS Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu_book" />



  <style>
    .meal-card {
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .meal-img-preview {
      width: 100%;
      max-height: 200px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>
<header>
        <div class="d-flex justify-content-between align-items-center">

            <!-- Include Service/Catering Navbar -->
            <?php include 'service_navbar.php'; ?>
        </div>
</header>
<body>
  <div class="container mt-4">
    <h1 class="text-center">Meal Menu Maker</h1>
    <div class="text-end mb-3">
      <button id="fetchMeals" class="btn btn-primary">Fetch Meals from MealDB</button>
    </div>

    <!-- Manual Meal Input Form -->
    <h2 class="text-center mt-4">Add a Meal Manually</h2>
    <form id="manualMealForm">
      <div class="mb-3">
        <label for="manualMealName" class="form-label">Meal Name</label>
        <input type="text" id="manualMealName" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="manualMealDescription" class="form-label">Meal Description</label>
        <textarea id="manualMealDescription" class="form-control" required></textarea>
      </div>
      <div class="mb-3">
        <label for="manualMealPrice" class="form-label">Price</label>
        <input type="number" id="manualMealPrice" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="manualMealImage" class="form-label">Meal Image</label>
        <input type="file" id="manualMealImage" class="form-control" accept="image/*" required>
        <img id="imagePreview" class="meal-img-preview mt-2" alt="Image Preview" style="display: none;">
      </div>
      <div class="mb-3">
        <label for="manualMealIngredients" class="form-label">Ingredients (comma separated)</label>
        <input type="text" id="manualMealIngredients" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success">Add Meal</button>
    </form>
    <hr>

    <div id="mealList" class="row"></div>
    <hr>
    <h2 class="text-center mt-4">Menu Preview</h2>
    <ul id="menuPreview" class="list-group"></ul>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    // MealDB API URL
    const mealDBURL = "https://www.themealdb.com/api/json/v1/1/search.php?s=";

    // Fetch Meals and Render
    document.getElementById("fetchMeals").addEventListener("click", async () => {
      try {
        const response = await fetch(mealDBURL);
        const data = await response.json();

        if (data.meals) {
          renderMealList(data.meals);
        } else {
          alert("No meals found.");
        }
      } catch (error) {
        console.error("Error fetching meals:", error);
      }
    });

    // Render Meal List
    function renderMealList(meals) {
      const mealList = document.getElementById("mealList");
      mealList.innerHTML = "";

      meals.forEach((meal) => {
        const ingredients = getIngredients(meal);

        const mealCard = document.createElement("div");
        mealCard.className = "meal-card col-md-4";

        mealCard.innerHTML = `
          <div>
            <label>Meal Image:</label>
            <input type="text" class="form-control mb-2 meal-img-url" value="${meal.strMealThumb}">
            <img src="${meal.strMealThumb}" class="meal-img-preview mb-2" alt="${meal.strMeal}">
          </div>
          <div>
            <label>Meal Name:</label>
            <input type="text" class="form-control mb-2 meal-name" value="${meal.strMeal}">
          </div>
          <div>
            <label>Description:</label>
            <textarea class="form-control mb-2 meal-description">${meal.strInstructions.slice(0, 50)}...</textarea>
          </div>
          <div>
            <label>Ingredients:</label>
            <ul class="list-group mb-2 editable-ingredients">
              ${ingredients.map((ing) => ` <li class="list-group-item"> <input type="text" class="form-control ingredient-item" value="${ing}"> </li>`).join("")}
            </ul>
            <button class="btn btn-sm btn-secondary mb-2 add-ingredient">Add Ingredient</button>
          </div>
          <div>
            <label>Price:</label>
            <input type="number" class="form-control mb-2 meal-price" placeholder="Set price">
          </div>
          <button class="btn btn-success btn-add-menu">Add to Menu</button>
        `;

        // Update Image Preview on URL Change
        const imgInput = mealCard.querySelector(".meal-img-url");
        const imgPreview = mealCard.querySelector(".meal-img-preview");
        imgInput.addEventListener("input", () => {
          imgPreview.src = imgInput.value;
        });

        // Add Ingredient
        mealCard.querySelector(".add-ingredient").addEventListener("click", () => {
          const ingredientList = mealCard.querySelector(".editable-ingredients");
          const newIngredient = document.createElement("li");
          newIngredient.className = "list-group-item";
          newIngredient.innerHTML = `
            <input type="text" class="form-control ingredient-item" placeholder="New Ingredient">
          `;
          ingredientList.appendChild(newIngredient);
        });

        // Add to Menu Button
        mealCard.querySelector(".btn-add-menu").addEventListener("click", () => {
          const name = mealCard.querySelector(".meal-name").value;
          const description = mealCard.querySelector(".meal-description").value;
          const price = mealCard.querySelector(".meal-price").value;
          const image = mealCard.querySelector(".meal-img-url").value;
          const ingredients = Array.from(
            mealCard.querySelectorAll(".ingredient-item")
          ).map((input) => input.value);

          if (!price || price <= 0) {
            alert("Please enter a valid price.");
            return;
          }

          addToMenu(name, description, price, image, ingredients);
        });

        mealList.appendChild(mealCard);
      });
    }

    // Extract Ingredients from Meal Object
    function getIngredients(meal) {
      const ingredients = [];
      for (let i = 1; i <= 20; i++) {
        const ingredient = meal[`strIngredient${i}`];
        const measure = meal[`strMeasure${i}`];
        if (ingredient) {
          ingredients.push(`${measure ? measure : ""} ${ingredient}`.trim());
        }
      }
      return ingredients;
    }

    // Add Meal to Menu
    function addToMenu(name, description, price, image, ingredients) {
      const serviceId = 1; // Replace with the actual service ID dynamically if needed

      fetch("add_meal.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          service_id: serviceId,
          name: name,
          description: description,
          price: price,
          image_url: image,
          ingredients: ingredients.join(", "), // Convert array to comma-separated string
        }),
      })
        .then((response) => response.text())
        .then((data) => {
          alert(data); // Show success or error message
        })
        .catch((error) => {
          console.error("Error adding meal:", error);
        });
    }

    // Manual Meal Form Submission
    document.getElementById("manualMealForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const name = document.getElementById("manualMealName").value;
      const description = document.getElementById("manualMealDescription").value;
      const price = document.getElementById("manualMealPrice").value;
      const imageFile = document.getElementById("manualMealImage").files[0];
      const ingredients = document.getElementById("manualMealIngredients").value.split(",").map(ingredient => ingredient.trim());

      if (!price || price <= 0) {
        alert("Please enter a valid price.");
        return;
      }

      // Convert the image to base64 and add it to the menu
      const reader = new FileReader();
      reader.onloadend = () => {
        const base64Image = reader.result;
        addToMenu(name, description, price, base64Image, ingredients);
      };
      reader.readAsDataURL(imageFile); // Read image file
    });

    // Image Preview
    document.getElementById("manualMealImage").addEventListener("change", function (e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
          document.getElementById("imagePreview").style.display = 'block';
          document.getElementById("imagePreview").src = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
</html>
