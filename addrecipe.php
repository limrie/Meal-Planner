<?php
	include_once "common/base.php";
	$pageTitle = "Add Recipe to Database";
	include_once "common/header.php";

	if(!empty($_POST['recipeName'])):
		include_once "inc/class.recipes.inc.php";
		$recipe = new FoodPlanRecipes($db);
		echo $recipe->addRecipe();
	else: 
?>

		<h2>Add a Recipe</h2>
		<form method="post" action="addrecipe.php" id="registerform">
			<div>
				<label for="recipeName">recipe Name:</label>
				<input type="text" name="recipeName" id="recipeName"/> <br>
				<label for="recipeCals">Calories:</label>
				<input type="text" name="recipeCals" id="recipeCals"/> <br>
				<label for="recipeFat">Fat:</label>
				<input type="text" name="recipeFat" id="recipeFat"/> <br>
				<label for="recipeSatFat">Saturated Fat:</label>
				<input type="text" name="recipeSatFat" id="recipeSatFat"/> <br>
				<label for="recipeCards">Carbohydrates:</label>
				<input type="text" name="recipeCarbs" id="recipeCarbs"/> <br>
				<label for="recipeSugars">Sugars:</label>
				<input type="text" name="recipeSugars" id="recipeSugars"/> <br>
				<label for="recipeFib">Fibre:</label>
				<input type="text" name="recipeFib" id="recipeFib"/> <br>
				<label for="recipeProtein">Protein:</label>
				<input type="text" name="recipeProtein" id="recipeProtein"/> <br>
				<label for="recipeSodium">Sodium:</label>
				<input type="text" name="recipeSodium" id="recipeSodium"/> <br>
				<label for="url">Photo URL:</label>
				<input type="url" name="photoURL" id="url" /> <br>
				<label for="method">Method:</label>
				<textarea name="method" id="method"></textarea> <br>
				<input type="submit" name="add" id="add" value="Add It" />
				<input type="hidden" name="token"
					value="<?php echo $_SESSION['token']; ?>" />
			</div>
		</form>

<?php
	endif;
	include_once 'common/footer.php';
?>