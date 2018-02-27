# Dignity Community

Source code of the phpland community.

## Technology

- Nginx or Apache
- HTML5 + CSS3 (Bootstrap), Javascript (jQuery)
- PHP 5.4.0+, MySQL, Yii Framework 2
- Composer (PHP), Bower and NPM (CSS, JavaScript)
- Markdown + CodeMirror Editor

## Key features

- User registration, login via E-Mail or Social Media (Github), logout
- Password reset
- User profile for each user
- Connect additional profiles (Github) to user profile
- Delete user profile
- Add, edit, delete user

- Add, edit, delete blog post (own, other users)
- Add, edit, delete blog comments (own, other users)
- Allow/Disallow blog comments
- Blog post views counter
- Blog post tags (in development)
- Blog post status: draft, publish
- Users blogs
- Show blog post from user blog on main page

- Markdown Support + CodeMirror Editor
- RBAC (admin, moderator, user)
- SEO friendly (Meta Title, Meta Keywords, Meta Description)
- Anti-spam protection (Registration, Comments, Contact form)

## Clone project via GIT

```
git clone https://github.com/dignityinside/community
cd community
```

## Install all dependencies via Composer

```
composer install
```

## Apply post create project script

```
composer run-script post-create-project-cmd
```

## Apply migrations

Setup DB settings in "config/db.php" and run migrations.

```
php yii migrate
```

## Apply RBAC

```
php yii rbac/init 
```

## Register new user and assign the roles

Setup reCAPTCHA settings in config/params.php and register a new user.

```
php yii rbac/assign admin dignity
php yii rbac/assign moderator dignity
```

## License
This project is licensed under the MIT License. See the LICENSE file for details.

## Contributing
1. Fork it
2. Create your feature branch (git checkout -b my-new-feature)
3. Make your changes
4. Commit your changes (git commit -am 'Added some feature')
5. Push to the branch (git push origin my-new-feature)
6. Create new Pull Request