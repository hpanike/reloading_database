CREATE DATABASE reloading;

USE reloading;

CREATE TABLE Handle (
handle_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
thread VARCHAR(255)
PRIMARY KEY (handle_id) );

CREATE TABLE Brush (
brush_id INT AUTO_INCREMENT NOT NULL,
caliber FLOAT,
thread VARCHAR(255),
material VARCHAR(255),
PRIMARY KEY (brush_id),
FOREIGN KEY (thread) REFERENCES Handle(thread)
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
material VARCHAR(255)
);

CREATE TABLE Case (
case_id INT AUTO_INCREMENT NOT NULL,
caliber FLOAT,
wall_thickness FLOAT,
use_expectancy INT,
manufacture VARCHAR(255),
amount INT,
cost FLOAT,
pocket_size CHAR(4),
PRIMARY KEY (case_id)
);

CREATE TABLE HandPrimer (
manufacture VARCHAR(255) NOT NULL,
PRIMARY KEY (manufacture)
);

CREATE TABLE CaseTrimmer (
ctrimmer_id INT AUTO_INCREMENT NOT NULL,
ctrimmer_type CHAR(4)
);

CREATE TABLE CleaningSolution (
solution_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255);
formula VARCHAR(255);
cost FLOAT,
amount FLOAT,
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

CREATE TABLE ShellHolder {
sholder_id INT AUTO_INCREMENT NOT NULL,
manufacture VARCHAR(255),
sholder_number INT,
sholder_range VARCHAR(255),
PRIMARY KEY sholder_id
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
production_rate INT,
thread VARCHAR(255),
PRIMARY KEY (press_id)
);

CREATE TABLE Die (
die_id INT AUTO_INCREMENT NOT NULL,
grade CHAR(4),
manufacture VARCHAR(255),
die_type VARCHAR(255),
caliber FLOAT,
PRIMARY KEY (die_id),
FOREIGN KEY (thread) REFERENCES Press(thread)
);

CREATE TABLE WorkBench (
wbench_id INT AUTO_INCREMENT NOT NULL;
name VARCHAR(255),
wbench_type VARCHAR(255),
wbench_size VARCHAR(255),
PRIMARY KEY (wbench_id)
);

CREATE TABLE Recipe (
recipe_id INT AUTO_INCREMENT NOT NULL;
powder_amount INT NOT NULL,
cost FLOAT,
amount_available INT,
ballistic_data VARCHAR(255),
PRIMARY KEY (recipe_id),
FOREIGN KEY (powder_id) REFERENCES Powder(powder_id),
FOREIGN KEY (case_id) REFERENCES Case(case_id),
FOREIGN KEY (primer_id) REFERENCES Primer(primer_id),
FOREIGN KEY (bullet_id) REFERENCES Bullet(bullet.id)
);
