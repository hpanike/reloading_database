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
quanity INT,
cost FLOAT,
PRIMARY KEY (primer_id)
);

CREATE TABLE PocketCleaner (
pcleaner_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
pcleaner_size CHAR(4),
pcleaner_type VARCHAR(255),
PRIMARY KEY (pcleaner_id)
);

CREATE TABLE UltrasonicCleaner (
ucleaner_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
ucleaner_size VARCHAR(255),
ucleaner_type CHAR(4),
PRIMARY KEY (ucleaner_id)
);

CREATE TABLE Bullet (
bullet_id INT AUTO_INCREMENT NOT NULL,
caliber FLOAT,
bullet_type VARCHAR(255),
manufacture VARCHAR(255),
grain INT,
ballistic_coefficient FLOAT,
cost FLOAT,
amount INT,
material VARCHAR(255),
PRIMARY KEY (bullet_id)
);

CREATE TABLE Casing (
casing_id INT AUTO_INCREMENT NOT NULL,
caliber FLOAT,
wall_thickness FLOAT,
use_expectancy INT,
manufacture VARCHAR(255),
amount INT,
cost FLOAT,
pocket_size CHAR(4),
PRIMARY KEY (casing_id)
);

CREATE TABLE HandPrimer (
manufacture VARCHAR(255) NOT NULL,
PRIMARY KEY (manufacture)
);

CREATE TABLE CasingTrimmer (
ctrimmer_id INT AUTO_INCREMENT NOT NULL,
ctrimmer_type CHAR(4),
PRIMARY KEY (ctrimmer_id)
);

CREATE TABLE CleaningSolution (
solution_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
formula VARCHAR(255),
cost FLOAT,
amount FLOAT,
ucleaner INT,
PRIMARY KEY (solution_id),
FOREIGN KEY (ucleaner) REFERENCES UltrasonicCleaner(ucleaner_id)
);

CREATE TABLE Powder (
powder_id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(255),
powder_type VARCHAR(255),
burn_rate VARCHAR(255),
quantity INT,
cost FLOAT,
PRIMARY KEY (powder_id)
);

CREATE TABLE Cartridge (
name VARCHAR(255),
year_created INT,
average_cost FLOAT,
availability CHAR(4),
PRIMARY KEY (name)
);

CREATE TABLE ShellHolder (
sholder_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
number INT,
PRIMARY KEY (sholder_id)
);

CREATE TABLE PowderDispenser (
pdispenser_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
pdispenser_type VARCHAR(255),
PRIMARY KEY (pdispenser_id)
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

CREATE TABLE WorkBench (
wbench_id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(255),
wbench_type VARCHAR(255),
wbench_size VARCHAR(255),
PRIMARY KEY (wbench_id)
);

CREATE TABLE Recipe (
recipe_id INT AUTO_INCREMENT NOT NULL,
powder_amount INT NOT NULL,
cost FLOAT,
amount_available INT,
ballistic_data VARCHAR(255),
powder INT,
casing INT,
primer INT,
bullet INT,
PRIMARY KEY (recipe_id),
FOREIGN KEY (powder) REFERENCES Powder(powder_id),
FOREIGN KEY (casing) REFERENCES Casing(casing_id),
FOREIGN KEY (primer) REFERENCES Primer(primer_id),
FOREIGN KEY (bullet) REFERENCES Bullet(bullet_id)
);
