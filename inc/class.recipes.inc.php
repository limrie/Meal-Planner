<?php

	class FoodPlanRecipes {
		/**
			 * The database object
			 * 
			 * @var object
			 */
			private $_db;
		
			/**
			 * Checks for a database object and creates one if none is found
			 * 
			 * @param object $db
			 * @return void
			 */
			public function __construct($db=NULL)
			{
				if(is_object($db))
				{
					$this->_db = $db;
				}
				else
				{
					$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
					try { 
						$this->_db = new PDO($dsn, DB_USER, DB_PASS);
						if(IS_DEBUG==1){
							$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}
					}  
					catch(PDOException $e) {  
						    echo $e->getMessage();  
					} 
				}
			}
			/**
			 * Checks and inserts a new recipe into the database
			 * 
			 * @return string	a message indicating the action status
			 */
			public function addRecipe() {
				$n = trim($_POST['recipeName']);
				$cal = trim($_POST['recipeCals']);
				$fat = trim($_POST['recipeFat']);
				$sf = trim($_POST['recipeSatFat']);
				$carb = trim($_POST['recipeCarbs']);
				$sug = trim($_POST['recipeSugars']);
				$fib = trim($_POST['recipeFib']);
				$p = trim($_POST['recipeProtein']);
				$na = trim($_POST['recipeSodium']);
				$m = strip_tags(urldecode(trim($_POST['method'])), WHITELIST);
				$photo = trim($_POST['photoURL']);
				
  
				
				$sql = "INSERT INTO recipes (RecipeName, RecipeMethod, RecipePhotoURL, Calories, Fat, SatFat, Carbs, Sugars, Fibre, Protein, Sodium) VALUES (:name, :method, :url, :cals, :fat, :satfat, :carb, :sugar, :fibre, :protein, :sodium)";
				
				try{
					$stmt = $this->_db->prepare($sql);
					
					$stmt->bindParam(':name', $n);
					$stmt->bindParam(':method', $m);
					$stmt->bindParam(':url', $photo);
					$stmt->bindParam(':cals', $cal);
					$stmt->bindParam(':fat', $fat);
					$stmt->bindParam(':satfat', $sf);
					$stmt->bindParam(':carb', $carb);
					$stmt->bindParam(':sugar', $sug);
					$stmt->bindParam(':fibre', $fib);
					$stmt->bindParam(':protein', $p);
					$stmt->bindParam(':sodium', $na);
					$stmt->execute();
					$stmt->closeCursor();
					
					return "<h2>Success</h2>"
						 . "<p>The new recipe "
						 . $n . " was added to the database. </p>";
				}
				catch(PDOException $e)
				{
					return $e->getMessage();
				}
			}
			
			
		
	}

?>