ALTER TABLE `blog_posts` DROP COLUMN `keywords` , DROP COLUMN `title` ;
ALTER TABLE `blog_post_contents` ADD COLUMN `title` VARCHAR(255) NOT NULL  AFTER `post_id` , ADD COLUMN `keywords` VARCHAR(255) NULL  AFTER `title` ;
