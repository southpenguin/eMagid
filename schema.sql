DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS SubCategory;
DROP TABLE IF EXISTS Category;

CREATE TABLE Category(
  id int(10) AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  slug varchar(100) NOT NULL UNIQUE,
  PRIMARY KEY (id)
);

CREATE TABLE SubCategory(
  id int(10) AUTO_INCREMENT,
  parent int(10) NOT NULL,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (parent) REFERENCES Category(id)
);

CREATE TABLE Product(
  id int(100) AUTO_INCREMENT,
  name varchar(200) NOT NULL,
  category int(10) NOT NULL,
  subcategory int(10),
  PRIMARY KEY (id),
  FOREIGN KEY (category) REFERENCES Category(id),
  FOREIGN KEY (subcategory) REFERENCES SubCategory(id)
);
  
  
