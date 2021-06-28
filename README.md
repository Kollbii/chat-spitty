# Hmmm… human music. -Jerry
Chat application or hidden game?

# You gotta shove these seeds way up your butt Morty, waay up there. -Rick

### Login
Register - First login with unique username.
![Login](assets/images/login.png)
If your username is unique your nick will be saved in DB. Only you can acces this nickname.
If interested please take a look at _login.php_

![Chat itself](assets/images/chat.png)

# Not storing passwords! Only hashes!
![Hashes](assets/images/passhash.png)
Don't worry! Your password is "safe" ;)
I'm using php _hash_hmac_ function using MD5. 
It's not much but it is one step further to make safer websites! Maybe I shouldn't use same static key for each user...

### [...] I wonder what the secret key could look like...
