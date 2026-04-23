CREATE TABLE IF NOT EXISTS activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    description TEXT NOT NULL,
    image_url VARCHAR(500)
);

TRUNCATE TABLE activities;

INSERT INTO activities (title, location, description, image_url) VALUES 
('River Rafting', 'Rishikesh', 'Experience the thrill of white-water rafting on the Ganges in Rishikesh.', 'https://images.unsplash.com/photo-1544641886-f138e6df61c7?auto=format&fit=crop&w=400&q=80'),
('Camel Safari', 'Rajasthan', 'Ride through the sweeping sand dunes of the Thar Desert in Rajasthan at sunset.', 'https://images.unsplash.com/photo-1542385151-efd01b1e95fa?auto=format&fit=crop&w=400&q=80'),
('Houseboat Cruise', 'Kerala', 'Relax on a traditional houseboat navigating the serene backwaters of Kerala.', 'https://images.unsplash.com/photo-1506461883276-594a12b11ac6?auto=format&fit=crop&w=400&q=80'),
('Scuba Diving', 'Andaman Islands', 'Explore vibrant coral reefs and marine life in the crystal-clear waters of the Andaman Islands.', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=400&q=80'),
('Himalayan Trekking', 'Himalayas', 'Challenge yourself with an unforgettable trek through the majestic valleys of the Himalayas.', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=400&q=80'),
('Paragliding', 'Himachal Pradesh', 'Soar high above the mountains taking in panoramic views in Bir Billing, Himachal Pradesh.', 'https://images.unsplash.com/photo-1505353140523-2675d045f276?auto=format&fit=crop&w=400&q=80');
