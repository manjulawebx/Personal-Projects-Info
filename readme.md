# ProjectsBook

This application is to maintain Web Project information as a Web Developer. Data will be stored in a MySQL database. Sensitive data like production environment passwords, hosting account, FTP passwords will be encrypted.

### Framworks & Technology

- CodeIgniter 3.1
- MySQL
- Tested with PHP8.2 (Originaly Developed to run on PHP 5.6)
- HTML & CSS

## Why this?

I wanted to keep my Web Projects Data on my local machine with their historical chnages data. This includes FTP/cPanel credentials, Testing URLs, CMS Admin login details (such as Wordpress). Also changes client requests time to time and what I did change in the project time to time.

So clients and projects are more than 5 years with me so I needed to have a solid safe place with my information. So this simple database and Codeigniter app creaed to store and retrive those data.

Security of these data must be managed by the device scurity and backup mode.

Even there are lot of Cloud spaces for this type of task managment I felt safe here with this. Because some cloud options disappear after some time or free services become paid mode so become no longer usable over time.

## Encryption

Encryption key is setup in <code>config.php</code>. Loose the key, will loose your encrypted data.

## Export Data

All projects data can be exported into simple html files. Exported files will be stored in <code>/exported/</code> folder. All sensitive data will be decoded and will be on HTML file as plain text. So those exported files **MUST COPY TO SOMEWHERE SECURE AND DELETE** <code>exported</code></span> folder content.
