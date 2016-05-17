# php-user
A blog post system using PHP and MYSQL

## Features

* Log in/out with password
* Mobile responsive
* Cached drafts
* Paging
* Comments
* Editing for owners
* API for articles

## Rules

* Users have to log in to post/comment
* Topics/contents have to be long enough
* Only owners can edit

## Database Structures

1. Auth:
<pre>
+--------------+-------------+------+-----+---------+----------------+
| Field        | Type        | Null | Key | Default | Extra          |
+--------------+-------------+------+-----+---------+----------------+
| id           | int(11)     | NO   | PRI | NULL    | auto_increment |
| username     | varchar(20) | YES  |     | NULL    |                |
| passwordhash | varchar(50) | YES  |     | NULL    |                |
+--------------+-------------+------+-----+---------+----------------+
</pre>

2. Post:
<pre>
+-----------+--------------+------+-----+---------+----------------+
| Field     | Type         | Null | Key | Default | Extra          |
+-----------+--------------+------+-----+---------+----------------+
| id        | int(11)      | NO   | PRI | NULL    | auto_increment |
| topic     | varchar(255) | YES  |     | NULL    |                |
| content   | longtext     | YES  |     | NULL    |                |
| author    | tinytext     | YES  |     | NULL    |                |
| post_time | tinytext     | YES  |     | NULL    |                |
+-----------+--------------+------+-----+---------+----------------+
</pre>

3. Comment:
<pre>
+-----------+----------+------+-----+---------+----------------+
| Field     | Type     | Null | Key | Default | Extra          |
+-----------+----------+------+-----+---------+----------------+
| id        | int(11)  | NO   | PRI | NULL    | auto_increment |
| articleId | int(11)  | NO   |     | NULL    |                |
| author    | tinytext | YES  |     | NULL    |                |
| content   | longtext | YES  |     | NULL    |                |
| post_time | tinytext | YES  |     | NULL    |                |
+-----------+----------+------+-----+---------+----------------+
</pre>

## Next Steps

- [x] Delete posts for owners
- [x] Make log in/out prettier
- [ ] Make pagination prettier
- [ ] Add some JS animations
- [ ] Move log in/out to main page
- [ ] Different authorization levels for users
- [ ] APIs for articles, comments and users
