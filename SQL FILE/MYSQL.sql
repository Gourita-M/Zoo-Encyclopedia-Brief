
CREATE DATABASE Zoo_Encyclopedia;

CREATE TABLE Habitat (
    IdHabitat INT PRIMARY KEY AUTO_INCREMENT,
    NomHab VARCHAR(100),
    Description_habi VARCHAR(300)
);

CREATE TABLE Animals (
    ID_Animals INT PRIMARY KEY AUTO_INCREMENT,
    Name_Animals VARCHAR(100),
    Alimentaire_type VARCHAR(50),
    Image_Animals VARCHAR(200),
    HabitatID INT,
    FOREIGN KEY(HabitatID) REFERENCES Habitat(IdHabitat)
);

INSERT INTO Habitat (NomHab, Description_habi) VALUES
('Savannah', 'Hot grassland area'),
('Jungle', 'Dense forest'),
('Desert', 'Dry sandy area'),
('Ocean', 'Large water habitat');

INSERT INTO Animals ( , Alimentaire_type, Image_Animals, HabitatID) VALUES
('Lion', 'Carnivore', 'lion.jpg', 1),
('Elephant', 'Herbivore', 'elephant.jpg', 1),
('Giraffe', 'Herbivore', 'giraffe.jpg', 1),
('Zebra', 'Herbivore', 'zebra.jpg', 1),
('Hyena', 'Carnivore', 'hyena.jpg', 1),

('Tiger', 'Carnivore', 'tiger.jpg', 2),
('Monkey', 'Omnivore', 'monkey.jpg', 2),
('Parrot', 'Herbivore', 'parrot.jpg', 2),
('Snake', 'Carnivore', 'snake.jpg', 2),
('Gorilla', 'Herbivore', 'gorilla.jpg', 2),

('Camel', 'Herbivore', 'camel.jpg', 3),
('Fennec Fox', 'Carnivore', 'fennec_fox.jpg', 3),
('Scorpion', 'Carnivore', 'scorpion.jpg', 3),
('Meerkat', 'Omnivore', 'meerkat.jpg', 3),
('Lizard', 'Carnivore', 'lizard.jpg', 3),

('Shark', 'Carnivore', 'shark.jpg', 4),
('Dolphin', 'Carnivore', 'dolphin.jpg', 4),
('Octopus', 'Carnivore', 'octopus.jpg', 4),
('Sea Turtle', 'Herbivore', 'sea_turtle.jpg', 4),
('Clownfish', 'Omnivore', 'clownfish.jpg', 4);
