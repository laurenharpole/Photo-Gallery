-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables

-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );


-- CREATE TABLE maptags (
-- 	tag_id INTEGER,
-- 	image_id INTEGER,
-- );




-- TODO: initial seed data

-- INSERT INTO `examples` (id,name) VALUES (1, 'example-1');
-- INSERT INTO `examples` (id,name) VALUES (2, 'example-2');
CREATE TABLE images (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	file_name TEXT NOT NULL,
	file_ext TEXT NOT NULL,
	description TEXT NOT NULL
);

-- documents seed data
-- TODO: uncomment the follow 2 seed data records
INSERT INTO images (id, file_name, file_ext, description) VALUES (1, 'img-4901.jpg', '.jpg', 'snowy dog');
INSERT INTO images (id, file_name, file_ext, description) VALUES (2, 'img-4902.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (3, 'img-4903.jpg', '.jpg', 'snowy dog 2');
INSERT INTO images (id, file_name, file_ext, description) VALUES (4, 'img-4904.jpg', '.jpg', 'snowy dog');
INSERT INTO images (id, file_name, file_ext, description) VALUES (5, 'img-4905.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (6, 'img-4906.jpg', '.jpg', 'snowy dog 2');
INSERT INTO images (id, file_name, file_ext, description) VALUES (7, 'img-4907.jpg', '.jpg', 'snowy dog');
INSERT INTO images (id, file_name, file_ext, description) VALUES (8, 'img-4908.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (9, 'img-4909.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (10, 'img-4910.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (11, 'img-4911.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (12, 'img-4912.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (13, 'img-4913.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (14, 'img-4914.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (15, 'img-4915.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (16, 'img-4916.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (17, 'img-4917.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (18, 'img-4918.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (19, 'img-4919.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (20, 'img-4920.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (21, 'img-4921.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (22, 'img-4922.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (23, 'img-4923.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (24, 'img-4924.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (25, 'img-4925.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (26, 'img-4926.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (27, 'img-4927.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (28, 'img-4928.jpg', '.jpg', 'Cornell''s seal');
-- INSERT INTO images (id, file_name, file_ext, description) VALUES (29, 'img-4929.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (30, 'img-4930.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (31, 'img-4931.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (32, 'img-4932.jpg', '.jpg', 'Cornell''s seal');
INSERT INTO images (id, file_name, file_ext, description) VALUES (33, 'img-4933.jpg', '.jpg', 'Cornell''s seal');

-- Students table seed data
CREATE TABLE tags (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	tag_name TEXT NOT NULL UNIQUE
);

INSERT INTO tags (id, tag_name) VALUES (1, 'glints');
INSERT INTO tags (id, tag_name) VALUES (2, 'nature');
INSERT INTO tags (id, tag_name) VALUES (3, 'portrait');
INSERT INTO tags (id, tag_name) VALUES (4, 'hazy');
INSERT INTO tags (id, tag_name) VALUES (5, 'cellophane');


-- -- Students table seed data
CREATE TABLE maptags (
	m_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	tag_id INTEGER NOT NULL,
	img_id INTEGER NOT NULL,
  FOREIGN KEY(tag_id) REFERENCES tags(id),
	FOREIGN KEY(img_id) REFERENCES images(id)
);

INSERT INTO maptags (m_id, tag_id, img_id) VALUES (1,3,4);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (2,3,2);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (3, 1,6);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (4,4,7);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (5, 4,6);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (6, 1,5);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (7,1,10);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (8, 5,6);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (9, 5,10);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (10,5,5);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (11,2,22);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (12,2,1);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (13,5,7);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (14,5,11);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (15,5,9);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (16,5,12);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (17,5,13);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (18,5,16);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (19,5,31);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (20,4,5);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (21,4,17);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (22,4,16);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (23,4,26);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (24,4,31);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (25,3,3);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (26,3,18);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (27,3,23);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (28,3,33);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (29,2,20);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (30,2,27);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (31,1,26);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (32,1,31);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (33,3,28);
INSERT INTO maptags (m_id, tag_id, img_id) VALUES (34,2,32);



-- TODO
-- CREATE TABLE maptags (
-- 	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	name TEXT NOT NULL UNIQUE,
-- 	image_id INTEGER NOT NULL,
-- 	tag_id INTEGER NOT NULL,
-- 	FOREIGN KEY(image_id) REFERENCES images(id),
-- 	FOREIGN KEY(tag_id) REFERENCES tags(id)
-- );
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,1,3);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (2,4,3);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (3,5,3);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (4,6,3);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (5,7,3);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (6,12,3);

-- INSERT INTO maptags (id, image_id, tag_id) VALUES (7,6,1);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (8,9,1);

-- INSERT INTO maptags (id, image_id, tag_id) VALUES (9,2,2);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (10,19,2);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (11,21,2);

-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,5,4);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,6,4);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,8,4);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,9,4);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,15,4);

-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,5,5);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,6,5);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,9,5);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,10,5);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,11,5);
-- INSERT INTO maptags (id, image_id, tag_id) VALUES (1,12,5);

COMMIT;
