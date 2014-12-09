CREATE DATABASE reloading;

USE reloading;

CREATE TABLE Handle (
handle_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
thread VARCHAR(255) NOT NULL,
PRIMARY KEY (handle_id) );

CREATE TABLE Brush (
brush_id INT AUTO_INCREMENT NOT NULL,
caliber FLOAT,
thread VARCHAR(255),
material VARCHAR(255),
handle INT,
PRIMARY KEY (brush_id),
FOREIGN KEY (handle) REFERENCES Handle(handle_id)
);

CREATE TABLE Primer (
primer_id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(255),
manufacture VARCHAR(255),
primer_size CHAR(4),
amount INT,
cost_per_primer FLOAT,
PRIMARY KEY (primer_id)
);

CREATE TABLE Pocket_Cleaner (
pocket_cleaner_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
pocket_cleaner_size CHAR(4),
pocket_cleaner_type VARCHAR(255),
PRIMARY KEY (pocket_cleaner_id)
);

CREATE TABLE Ultrasonic_Cleaner (
ultrasonic_cleaner_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
ultrasonic_cleaner_size VARCHAR(255),
ultrasonic_cleaner_type CHAR(4),
PRIMARY KEY (ultrasonic_cleaner_id)
);

CREATE TABLE Bullet (
bullet_id INT AUTO_INCREMENT NOT NULL,
bullet_name VARCHAR(255),
caliber FLOAT,
bullet_type VARCHAR(255),
manufacture VARCHAR(255),
grain INT,
ballistic_coefficient FLOAT,
cost_per_bullet FLOAT,
amount INT,
material VARCHAR(255),
PRIMARY KEY (bullet_id)
);

CREATE TABLE Casing (
casing_id INT AUTO_INCREMENT NOT NULL,
casing_name VARCHAR(255),
caliber FLOAT,
wall_thickness FLOAT,
use_expectancy INT,
amount INT,
cost_per_casing FLOAT,
pocket_size CHAR(4),
PRIMARY KEY (casing_id)
);

CREATE TABLE Hand_Primer (
manufacture VARCHAR(255) NOT NULL,
PRIMARY KEY (manufacture)
);

CREATE TABLE Casing_Trimmer (
casing_trimmer_id INT AUTO_INCREMENT NOT NULL,
casing_trimmer_type CHAR(4),
PRIMARY KEY (casing_trimmer_id)
);

CREATE TABLE Cleaning_Solution (
solution_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
formula VARCHAR(255),
cost FLOAT,
amount FLOAT,
ultrasonic_cleaner INT,
PRIMARY KEY (solution_id),
FOREIGN KEY (ultrasonic_cleaner) REFERENCES Ultrasonic_Cleaner(ultrasonic_cleaner_id)
);

CREATE TABLE Powder (
powder_id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(255),
powder_type VARCHAR(255),
burn_rate VARCHAR(255),
amount_in_grains FLOAT,
cost_per_grain FLOAT,
PRIMARY KEY (powder_id)
);

CREATE TABLE Cartridge (
name VARCHAR(255),
year_created INT,
average_cost FLOAT,
availability CHAR(4),
PRIMARY KEY (name)
);

CREATE TABLE Shell_Holder (
shell_holder_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
number INT,
PRIMARY KEY (shell_holder_id)
);

CREATE TABLE Powder_Dispenser (
powder_dispenser_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
pdispenser_type VARCHAR(255),
PRIMARY KEY (powder_dispenser_id)
);

CREATE TABLE Press (
press_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
production_rate INT,
press_type CHAR(4),
thread VARCHAR(255),
PRIMARY KEY (press_id)
);

CREATE TABLE Die (
die_id INT AUTO_INCREMENT NOT NULL,
grade CHAR(4),
manufacture VARCHAR(255),
die_type VARCHAR(255),
caliber FLOAT,
press INT,
PRIMARY KEY (die_id),
FOREIGN KEY (press) REFERENCES Press(press_id)
);

CREATE TABLE Work_Bench (
work_bench_id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(255),
work_bench_type VARCHAR(255),
wwork_bench_size VARCHAR(255),
PRIMARY KEY (work_bench_id)
);

CREATE TABLE Recipe (
recipe_id INT AUTO_INCREMENT NOT NULL,
recipe_name VARCHAR(255),
bullet INT,
powder INT,
powder_amount_in_grains FLOAT,
casing INT,
primer INT,
ballistic_data VARCHAR(255),
cost_per_bullet FLOAT,
amount_available INT,
PRIMARY KEY (recipe_id),
FOREIGN KEY (powder) REFERENCES Powder(powder_id),
FOREIGN KEY (casing) REFERENCES Casing(casing_id),
FOREIGN KEY (primer) REFERENCES Primer(primer_id),
FOREIGN KEY (bullet) REFERENCES Bullet(bullet_id)
);
