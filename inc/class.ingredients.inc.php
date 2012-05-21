<?php

	class FoodPlanIngredients {
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
						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					}  
					catch(PDOException $e) {  
						    echo $e->getMessage();  
					} 
				}
			}
			/**
			 * Checks and inserts a new ingredient into the database
			 * 
			 * @return string	a message indicating the action status
			 */
			public function addIngredient() {
				$n = trim($_POST['ingredientName']);
				$cal = trim($_POST['ingredientCals']);
				$fat = trim($_POST['ingredientFat']);
				$sf = trim($_POST['ingredientSatFat']);
				$carb = trim($_POST['ingredientCarbs']);
				$sug = trim($_POST['ingredientSugars']);
				$fib = trim($_POST['ingredientFib']);
				$p = trim($_POST['ingredientProtein']);
				$na = trim($_POST['ingredientSodium']);
				
				$sql = "SELECT COUNT(IngredientName) AS theCount
						FROM Ingredients
						WHERE IngredientName= :name";
				
				if($stmt = $this->_db->prepare($sql)){
					$stmt->bindParam(":name", $n, PDO::PARAM_STR);
					$stmt->execute();
					$row = $stmt->fetch();
					if($row['theCount']!=0){
						return "<h2>Error</h2>"
							 . "<p> That ingredient already exists.</p>";
							
					}
					
					$stmt->closeCursor();	
				}  
				
				$sql = "INSERT INTO ingredients (IngredientName, IngredientCalories, IngredientFat, IngredientSatFat, IngredientCarbs, IngredientSugars, IngredientFibre, IngredientProtein, IngredientSodium) VALUES (:name, :cals, :fat, :satfat, :carb, :sugar, :fibre, :protein, :sodium)";
				
				try{
					$stmt = $this->_db->prepare($sql);
					
					$stmt->bindParam(':name', $n);
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
						 . "<p>The new ingredient "
						 . $n . " was added to the database. </p>";
				}
				catch(PDOException $e)
				{
					return $e->getMessage();
				}
			}
			
			
		
	}

?>