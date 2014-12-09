------------- THIS AREA IS TRIGGERS FOR THE RECIPES TABLE ----------------------------

-- Trigger DDL Statements
DELIMITER $$

USE `reloading`$$

CREATE
DEFINER=`root`@`localhost`
TRIGGER `reloading`.`before_insert`
BEFORE INSERT ON `reloading`.`Recipe`
FOR EACH ROW
BEGIN
    DECLARE bullet_cost FLOAT;
    DECLARE primer_cost FLOAT; 
    DECLARE casing_cost FLOAT;
    DECLARE powder_per_grain FLOAT;
    DECLARE powder_cost FLOAT;
    DECLARE total_cost FLOAT;

    DECLARE bullet_amount INT;
    DECLARE primer_amount INT;
    DECLARE casing_amount INT;
    DECLARE powder_amount FLOAT;
    DECLARE powders_possible FLOAT;
    DECLARE rounds_with_powder INT;
    DECLARE max_possible_rounds INT;

    SET bullet_cost = (SELECT cost_per_bullet FROM Bullet WHERE bullet_id = NEW.bullet);
    SET primer_cost = (SELECT cost_per_primer FROM Primer WHERE primer_id = NEW.primer);
    SET casing_cost = (SELECT cost_per_casing FROM Casing WHERE casing_id = NEW.casing);
    SET powder_per_grain = (SELECT cost_per_grain FROM Powder WHERE powder_id = NEW.powder);
    SET powder_cost = (powder_per_grain * NEW.powder_amount_in_grains);
    SET total_cost = (powder_cost + bullet_cost + primer_cost + casing_cost);
    SET NEW.cost_per_bullet = (SELECT TRUNCATE((SELECT total_cost), 2));

    SET bullet_amount = (SELECT amount FROM Bullet WHERE bullet_id = NEW.bullet);
    SET primer_amount = (SELECT amount FROM Primer WHERE primer_id = NEW.primer);
    SET casing_amount = (SELECT amount FROM Casing WHERE casing_id = NEW.casing);
    SET powder_amount = (SELECT amount_in_grains FROM Powder WHERE powder_id = NEW.powder);
    SET powders_possible = (powder_amount / NEW.powder_amount_in_grains);
    SET rounds_with_powder = (SELECT CONVERT((SELECT powders_possible), SIGNED));
    SET max_possible_rounds = (SELECT LEAST((SELECT bullet_amount),(SELECT primer_amount),(SELECT casing_amount),(SELECT rounds_with_powder)));
    SET NEW.amount_available = (SELECT max_possible_rounds); 
    
END$$

CREATE
DEFINER=`root`@`localhost`
TRIGGER `reloading`.`before_update_fix_cost`
BEFORE UPDATE ON `reloading`.`Recipe`
FOR EACH ROW
BEGIN
  DECLARE bullet_cost FLOAT;
    DECLARE primer_cost FLOAT; 
    DECLARE casing_cost FLOAT;
    DECLARE powder_per_grain FLOAT;
    DECLARE powder_cost FLOAT;
    DECLARE total_cost FLOAT;

    DECLARE bullet_amount INT;
    DECLARE primer_amount INT;
    DECLARE casing_amount INT;
    DECLARE powder_amount FLOAT;
    DECLARE powders_possible FLOAT;
    DECLARE rounds_with_powder INT;
    DECLARE max_possible_rounds INT;

    SET bullet_cost = (SELECT cost_per_bullet FROM Bullet WHERE bullet_id = NEW.bullet);
    SET primer_cost = (SELECT cost_per_primer FROM Primer WHERE primer_id = NEW.primer);
    SET casing_cost = (SELECT cost_per_casing FROM Casing WHERE casing_id = NEW.casing);
    SET powder_per_grain = (SELECT cost_per_grain FROM Powder WHERE powder_id = NEW.powder);
    SET powder_cost = (powder_per_grain * NEW.powder_amount_in_grains);
    SET total_cost = (powder_cost + bullet_cost + primer_cost + casing_cost);
    SET NEW.cost_per_bullet = (SELECT TRUNCATE((SELECT total_cost), 2));

    SET bullet_amount = (SELECT amount FROM Bullet WHERE bullet_id = NEW.bullet);
    SET primer_amount = (SELECT amount FROM Primer WHERE primer_id = NEW.primer);
    SET casing_amount = (SELECT amount FROM Casing WHERE casing_id = NEW.casing);
    SET powder_amount = (SELECT amount_in_grains FROM Powder WHERE powder_id = NEW.powder);
    SET powders_possible = (powder_amount / NEW.powder_amount_in_grains);
    SET rounds_with_powder = (SELECT CONVERT((SELECT powders_possible), SIGNED));
    SET max_possible_rounds = (SELECT LEAST((SELECT bullet_amount),(SELECT primer_amount),(SELECT casing_amount),(SELECT rounds_with_powder)));
    SET NEW.amount_available = (SELECT max_possible_rounds); 
END$$


--------------- THIS AREA IS TRIGGERS FOR THE OTHER AREAS -----------------------------
