<?php
	include_once "common/base.php";
	$pageTitle = "Add Ingredient to Database";
	include_once "common/header.php";

	if(!empty($_POST['ingredientName'])):
		include_once "inc/class.ingredients.inc.php";
		$ingredient = new FoodPlanIngredients($db);
		echo $ingredient->addIngredient();
	else: 
?>

		<h2>Add an Ingredient</h2>
		<form method="post" action="addingredient.php" id="registerform">
			<div>
				<label for="ingredientName">Ingredient Name:</label>
				<input type="text" name="ingredientName" id="ingredientName"/> <br>
				<label for="ingredientCals">Calories:</label>
				<input type="text" name="ingredientCals" id="ingredientCals"/> <br>
				<label for="ingredientFat">Fat:</label>
				<input type="text" name="ingredientFat" id="ingredientFat"/> <br>
				<label for="ingredientSatFat">Saturated Fat:</label>
				<input type="text" name="ingredientSatFat" id="ingredientSatFat"/> <br>
				<label for="ingredientCards">Carbohydrates:</label>
				<input type="text" name="ingredientCarbs" id="ingredientCarbs"/> <br>
				<label for="ingredientSugars">Sugars:</label>
				<input type="text" name="ingredientSugars" id="ingredientSugars"/> <br>
				<label for="ingredientFib">Fibre:</label>
				<input type="text" name="ingredientFib" id="ingredientFib"/> <br>
				<label for="ingredientProtein">Protein:</label>
				<input type="text" name="ingredientProtein" id="ingredientProtein"/> <br>
				<label for="ingredientSodium">Sodium:</label>
				<input type="text" name="ingredientSodium" id="ingredientSodium"/> <br>
				<input type="submit" name="add" id="add" value="Add It" />
				<input type="hidden" name="token"
					value="<?php echo $_SESSION['token']; ?>" />
			</div>
		</form>

<?php
	endif;
	include_once 'common/footer.php';
?>