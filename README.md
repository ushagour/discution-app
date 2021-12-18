

# laravel ui 


# Git

### clone l project men github

```
git clone url of rep
```
# composer

### install package 

```
Run composer install
```


# laravel
```
 php artisan key:generate.
```



# Database

### Kifach ndir bach n3amar db btables ?
```
php artisan migrate
```

### Kifach ndir ila tra liya error f migration ?
```
php artisan migrate:fresh
```
### create migration tables 
```
php artisan make:migration create_users_table
```

### Kifach ndir bach ndekhel users dyal test ?
```
php artisan db:seed --class=UsersSeeder
```

# Migrations
### drop constrainte colums

```php
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign("categories_type_id_foreign");
            $table->dropColumn("type_id");
        });
    }
```

