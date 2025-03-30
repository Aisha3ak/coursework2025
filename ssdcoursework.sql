CREATE DATABASE ssdcoursework;
USE ssdcoursework;

CREATE TABLE Users(
    UserID int not null AUTO_INCREMENT,
    UserName varchar(16) not null,
    FullName varchar(128) not null,
    Email varchar(128) not null,
    ProfilePic varchar(128),
    Password varchar(16) not null,
    CONSTRAINT pri_user_id PRIMARY KEY (UserID)
);

CREATE TABLE Photographs(
    ImageID int not null AUTO_INCREMENT,
	ImageTitle varchar(200) not null,
    Description varchar(300) not null,
    Image varchar(128) not null,
	UserID int not null,
    CONSTRAINT pri_image_id PRIMARY KEY (ImageID),
    CONSTRAINT for_user_id FOREIGN KEY (UserID)
    REFERENCES Users (UserID) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE Comments(
	CommentID INT NOT NULL auto_increment,
    Fullname varchar(128) not null,
    ProfilePic varchar(128),
	Comment varchar (128) not null,
	UserID int not null,
    ImageID int not null,
	CONSTRAINT pri_comment_id PRIMARY KEY (CommentID),
    CONSTRAINT for_user_id2 FOREIGN KEY (UserID)
    REFERENCES Users (UserID) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT for_image_id FOREIGN KEY (ImageID)
    REFERENCES Photographs (ImageID) ON UPDATE CASCADE ON DELETE CASCADE
    );
    
    
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('hajarelmoctar', 'Hajar El Moctar', 'hajarelmoctar@test.com', 'profile1.jpg', 'password');
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('saraidris', 'Sara Idris', 'saraidris@test.com', 'profile2.jpg', 'password');
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('nada', 'Nada', 'nada@test.com', 'profile3.jpg', 'password');
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('yaramohamed', 'Yara Mohamed', 'yara@test.com', 'profile4.jpg', 'password');
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('iman', 'Iman', 'iman@test.com', 'profile5.jpg', 'password');
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('rashid', 'Rashid Mohamed', 'rashid@test.com', 'profile6.jpg', 'password');
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('abdullah', 'Abdullah Althani', 'abdullah@test.com', 'profile7.jpg', 'password');
INSERT INTO Users (UserName, FullName, Email, ProfilePic, Password) VALUES ('khalidabdulaziz', 'Khalid Abdulaziz', 'khalid@test.com', 'profile8.jpg', 'password');
    
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Elegant Evening Ambiance', 'A cozy setting with warm lanterns and inviting chairs, perfect for intimate conversations and peaceful moments.', 'image1.jpg', 1);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Contrast of Life', 'White petunias bloom against vibrant green foliage, juxtaposed with dried palm fibers creating a striking natural contrast between flourishing life and weathered textures in this garden-edge composition.', 'image2.jpg', 1);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Tranquil Garden Escape', 'A soothing fountain surrounded by lush greenery, creating a serene retreat with the gentle sound of flowing water.', 'image3.jpg', 2);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Blurred Beauty', 'A vibrant flower softly out of focus, a reminder that beauty is sometimes best appreciated beyond the sharp edges of life.', 'image4.jpg', 2);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Sunset Clusters', 'Delicate lantana blossoms display their signature two-tone coloration of pink petals surrounding yellow centers, clustered together against rich green foliage in a dreamy, shallow-focus composition.', 'image5.jpg', 3);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Twilight Blooms', 'Lantana flowers with pink-rimmed petals and golden centers emerge from woody stems and textured green leaves, their vibrant colors punctuating the dusky ambient light as evening approaches', 'image6.jpg', 3);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Solitary Violet', 'A delicate purple flower stands in sharp focus against a blurred backdrop of stems and leaves, its five petals unfurling like a star in the wilderness—a lone splash of color in the muted undergrowth.', 'image7.jpg', 4);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Magenta Symphony', 'Vibrant bougainvillea creates a dazzling tapestry of magenta bracts punctuated by tiny white flowers, their paper-like texture contrasting with glossy green leaves in this sun-drenched tropical display.', 'image8.jpg', 4);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Tropical Sanctuary', 'A rustic wooden pergola stands amid a lush botanical paradise, framed by magenta bougainvillea and white flowering shrubs under brilliant blue skies—an inviting oasis of shade in a sun-drenched tropical garden.', 'image9.jpg', 5);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Pathway', 'A beautiful sign surrounded by lush green inviting people to walk in the shade.', 'image10.jpg', 5);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Lush Greenery', 'Two beautiful plants in a contrasting natural arrangement.', 'image11.jpg', 6);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Contrasting Bark', 'Enjoy the contrast between this beautiful palm tree bark and the background hedge.', 'image12.jpg', 6);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Cobblestone', 'A dark but beautiful image of a cobblestone pathway.', 'image13.jpg', 7);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Heaven', 'A view of distant overwater villas on a beach resort, truly heaven.', 'image14.jpg', 7);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Vacation Vibes', 'Who wouldnt want to spend their vacation here?', 'image15.jpg', 8);
INSERT INTO Photographs (ImageTitle, Description, Image, UserID) VALUES ('Balcony View', 'The balcony overlooks a beautiful portion of beach, a pool and greenery.', 'image16.jpg', 8);

INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Hajar El Moctar', 'profile1.jpg', 'Artistic photograph!', 1, 1);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Hajar El Moctar', 'profile1.jpg', 'Wow. Amazing!', 1, 2);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Hajar El Moctar', 'profile1.jpg', 'How Beautiful!', 1, 6);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Sara Idris', 'profile2.jpg', 'How Wonderful!', 2, 2);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Sara Idris', 'profile2.jpg', 'How Beautiful!', 2, 10);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Sara Idris', 'profile2.jpg', 'How Beautiful!', 2, 12);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Nada', 'profile3.jpg', 'How Beautiful!', 3, 2);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Nada', 'profile3.jpg', 'How Beautiful!', 3, 11);
INSERT INTO Comments (Fullname, ProfilePic, Comment, UserID, ImageID) VALUES ('Nada', 'profile3.jpg', 'How Beautiful!', 3, 13);























    