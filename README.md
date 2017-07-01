# ShowColumn
A Laravel package to generate PHP, JS, HTML code related to DB table column.  
(This package is maintained under L5.4)

# Installation

Execute the next command.

    composer require sukohi/show-column:1.*

Set the service providers in app.php

    'providers' => [
        ...Others...,
        Sukohi\ShowColumn\ShowColumnServiceProvider::class,
    ]

Now you have `code:db` in `php artisan` commands.

# Usage

**Basic**

You need to set two arguments to run this package like so.

    php artisan code:db (Model) (SHOWING_TYPE)
    
(e.g.)

    php artisan code:db User array

* In this case, User means `App\User`.

or 

    php artisan code:db App\\User array
    
SHOWING_TYPEs

* array
* rule
* getter
* setter
* request
* js
* seed
* html

**array**

    php artisan code:db User array
    
(output)

    $array = [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'remember_token' => 'remember_token',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

**rule**

    php artisan code:db User rule
    
(output)

    return [
        'id' => 'required',
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'remember_token' => 'required',
        'created_at' => 'required',
        'updated_at' => 'required',
    ];


**getter**

    php artisan code:db User getter
    
(output)

    $id = $user->id;
    $name = $user->name;
    $email = $user->email;
    $password = $user->password;
    $remember_token = $user->remember_token;
    $created_at = $user->created_at;
    $updated_at = $user->updated_at;
    $created_on = $user->created_on;

Note: Output code is including accessors.

**setter**

    php artisan code:db User setter
    
(output)

    // Variable
    $user = new \App\User();
    $user->id = $id;
    $user->name = $name;
    $user->email = $email;
    $user->password = $password;
    $user->remember_token = $remember_token;
    $user->created_at = $created_at;
    $user->updated_at = $updated_at;
    $user->created_on = $created_on;
    $user->save();
    
    // Request
    $user = new \App\User();
    $user->id = $request->id;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->remember_token = $request->remember_token;
    $user->created_at = $request->created_at;
    $user->updated_at = $request->updated_at;
    $user->created_on = $request->created_on;
    $user->save();

Note: Output code is including mutators.

**request**

    php artisan code:db User request
    
(output)

    $id = $request->id;
    $name = $request->name;
    $email = $request->email;
    $password = $request->password;
    $remember_token = $request->remember_token;
    $created_at = $request->created_at;
    $updated_at = $request->updated_at;

**js**

    php artisan code:db User js
    
(output)

    // Basic
    var id = user.id;
    var name = user.name;
    var email = user.email;
    var password = user.password;
    var providerName = user.providerName;
    var providerId = user.providerId;
    var rememberToken = user.rememberToken;
    var createdAt = user.createdAt;
    var updatedAt = user.updatedAt;
    
    // Vue
    this.id = user.id;
    this.name = user.name;
    this.email = user.email;
    this.password = user.password;
    this.providerName = user.providerName;
    this.providerId = user.providerId;
    this.rememberToken = user.rememberToken;
    this.createdAt = user.createdAt;
    this.updatedAt = user.updatedAt;

**seed**

    php artisan code:db User seed

(output)

    $user = new \App\User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->remember_token = $request->remember_token;
    $user->created_on = $request->created_on;
    $user->save();


**html**

    php artisan code:db User html
    
(output)

    <!-- Empty -->
    <input type="text" name="id" value="">
    <input type="text" name="name" value="">
    <input type="text" name="email" value="">
    <input type="text" name="password" value="">
    <input type="text" name="remember_token" value="">
    <input type="text" name="created_at" value="">
    <input type="text" name="updated_at" value="">
    
    <!-- with Values -->
    <input type="text" name="id" value="{{ $user->id }}">
    <input type="text" name="name" value="{{ $user->name }}">
    <input type="text" name="email" value="{{ $user->email }}">
    <input type="text" name="password" value="{{ $user->password }}">
    <input type="text" name="remember_token" value="{{ $user->remember_token }}">
    <input type="text" name="created_at" value="{{ $user->created_at }}">
    <input type="text" name="updated_at" value="{{ $user->updated_at }}">
    
    <!-- Vue -->
    <input type="text" name="id" v-model="id">
    <input type="text" name="name" v-model="name">
    <input type="text" name="email" v-model="email">
    <input type="text" name="password" v-model="password">
    <input type="text" name="remember_token" v-model="rememberToken">
    <input type="text" name="created_at" v-model="createdAt">
    <input type="text" name="updated_at" v-model="updatedAt">

# License

This package is licensed under the MIT License.  
Copyright 2017 Sukohi Kuhoh