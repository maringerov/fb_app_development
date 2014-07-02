CREATE TABLE recipes(
	recipe_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
	recipe_name VARCHAR(255) NOT NULL,
	recipe_date INT(11) NOT NULL,
	recipe_ingredients MEDIUMTEXT NOT NULL,
	recipe_text TEXT NOT NULL,
	fb_id INT(32) NOT NULL,
	fb_user_name VARCHAR(255) NOT NULL,
	image_url VARCHAR(255) NOT NULL
	);

CREATE TABLE recipe_types(
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
	recipe_name VARCHAR(255) NOT NULL,
	recipe_type ENUM('salad','starter','main','dessert') NOT NULL
	);

INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 1', 'salad');
INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 2', 'salad');
INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 3', 'starter');
INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 4', 'starter');
INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 5', 'main');
INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 6', 'main');
INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 7', 'dessert');
INSERT INTO recipe_types(recipe_name, recipe_type) VALUES ('Recipe 8', 'dessert');